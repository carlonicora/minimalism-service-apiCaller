<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Tests\Unit\Factories;

use CarloNicora\Minimalism\Services\ApiCaller\ApiCaller;
use CarloNicora\Minimalism\Services\ApiCaller\Configurations\ApiCallerConfigurations;
use CarloNicora\Minimalism\Services\ApiCaller\Factories\ServiceFactory;
use CarloNicora\Minimalism\Services\ApiCaller\Tests\Abstracts\AbstractTestCase;
use Exception;

class ServiceFactoryTest extends AbstractTestCase
{
    /**
     * @return ServiceFactory
     * @throws Exception
     */
    public function testServiceInitialisation() : ServiceFactory
    {
        $response = new ServiceFactory($this->getServices());

        $this->assertEquals(1,1);

        return $response;
    }

    /**
     * @param ServiceFactory $service
     * @depends testServiceInitialisation
     * @throws Exception
     */
    public function testServiceCreation(ServiceFactory $service) : void
    {
        $config = new ApiCallerConfigurations();
        $services = $this->getServices();
        $rabbitmq = new ApiCaller($config, $services);

        $this->assertEquals($rabbitmq, $service->create($services));
    }
}