<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Factories;

use CarloNicora\Minimalism\core\Services\exceptions\configurationException;
use CarloNicora\Minimalism\core\Services\abstracts\abstractServiceFactory;
use CarloNicora\Minimalism\Services\ApiCaller\ApiCaller;
use CarloNicora\Minimalism\Services\ApiCaller\Configurations\ApiCallerConfigurations;
use CarloNicora\Minimalism\core\Services\factories\ServicesFactory;

class ServiceFactory extends abstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param ServicesFactory $services
     * @throws ConfigurationException
     */
    public function __construct(servicesFactory $services)
    {
        $this->configData = new ApiCallerConfigurations();

        parent::__construct($services);
    }

    /**
     * @param ServicesFactory $services
     * @return ApiCaller
     */
    public function create(servicesFactory $services): ApiCaller
    {
        return new ApiCaller($this->configData, $services);
    }
}