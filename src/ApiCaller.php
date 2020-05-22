<?php
namespace CarloNicora\Minimalism\Services\ApiCaller;

use CarloNicora\JsonApi\Document;
use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractService;
use CarloNicora\Minimalism\Core\Services\Interfaces\ServiceConfigurationsInterface;
use CarloNicora\Minimalism\Services\ApiCaller\Configurations\ApiCallerConfigurations;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\Security\Security;
use Exception;
use JsonException;

class ApiCaller extends abstractService {
    /** @var ApiCallerConfigurations */
    private ApiCallerConfigurations $configData;

    /**
     * abstractApiCaller constructor.
     * @param ServiceConfigurationsInterface $configData
     * @param ServicesFactory $services
     */
    public function __construct(ServiceConfigurationsInterface $configData, ServicesFactory $services) {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
    }

    /**
     * @param string $verb
     * @param string $url
     * @param string $endpoint
     * @param array|null $body
     * @param string|null $hostname
     * @return Document
     * @throws JsonException|Exception
     */
    public function call(string $verb, string $url, string $endpoint, array $body=null, string $hostname=null): Document
    {
        $curl = curl_init();
        $httpHeaders = array();

        if (!empty($hostname)){
            $httpHeaders[] = 'Host: ' . $hostname;
        }

        switch ($verb){
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, 1);
                $httpHeaders[] = 'Content-Type:application/json';
                if (is_array($body)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body, JSON_THROW_ON_ERROR, 512));
                }
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                $httpHeaders[] = 'Content-Type:application/json';
                if (is_array($body)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body, JSON_THROW_ON_ERROR, 512));
                }
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                $httpHeaders[] = 'Content-Type:application/json';
                if (is_array($body)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body, JSON_THROW_ON_ERROR, 512));
                }
                break;
            default:
                if (isset($body)) {
                    $query = http_build_query($body);
                    if (!empty($query)) {
                        $endpoint .= ((substr_count($endpoint, '?') > 0) ? '&' : '?') . $query;
                    }

                    $body = null;
                }
                break;
        }

        /** @var security $security */
        $security = $this->services->service(Security::class);

        if (!empty($security->getClientId())) {
            $signature = $security->generateSignature($verb, $endpoint, $body, $security->getClientId(), $security->getClientSecret(), $security->getPublicKey(), $security->getPrivateKey());
            $httpHeaders[] = $security->getHttpHeaderSignature() . ':' . $signature;
        }

        $info = null;
        $httpCode = null;

        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $httpHeaders,
            CURLOPT_URL => $url. $endpoint,
            CURLOPT_VERBOSE => 1,
            CURLOPT_HEADER => 1
        ];

        if ($this->configData->getAllowUnsafeApiCalls()){
            /** @noinspection CurlSslServerSpoofingInspection */
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            /** @noinspection CurlSslServerSpoofingInspection */
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        curl_setopt_array($curl, $options);

        $curlResponse = curl_exec($curl);

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $returnedJson = substr($curlResponse, $header_size);

        if (isset($curl)) {
            curl_close($curl);
        }

        $apiResponse = json_decode($returnedJson, true, 512, JSON_THROW_ON_ERROR);

        return new Document($apiResponse);
    }
}