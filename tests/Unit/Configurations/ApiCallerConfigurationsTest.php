<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Tests\Unit\Configurations;

use CarloNicora\Minimalism\Services\ApiCaller\Configurations\ApiCallerConfigurations;
use CarloNicora\Minimalism\Services\ApiCaller\Tests\Abstracts\AbstractTestCase;

class ApiCallerConfigurationsTest extends AbstractTestCase
{

    public function testUnconfiguredConfiguration() : void
    {
        $config = new ApiCallerConfigurations();
        $this->assertEquals(false, $config->getAllowUnsafeApiCalls());
    }

    public function testConfiguredConfigurationDomain() : void
    {
        $this->setEnv('ALLOW_UNSAFE_API_CALLS', 'true');

        $config = new ApiCallerConfigurations();
        $this->assertEquals(true, $config->getAllowUnsafeApiCalls());
    }
}