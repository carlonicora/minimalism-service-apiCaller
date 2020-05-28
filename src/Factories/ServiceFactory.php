<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Factories;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceFactory;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\ApiCaller\ApiCaller;
use CarloNicora\Minimalism\Services\ApiCaller\Configurations\ApiCallerConfigurations;

class ServiceFactory extends AbstractServiceFactory {
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