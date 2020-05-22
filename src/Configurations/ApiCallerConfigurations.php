<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Configurations;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceConfigurations;
use CarloNicora\Minimalism\Services\Security\Security;

class ApiCallerConfigurations extends AbstractServiceConfigurations
{
    /** @var bool */
    private bool $allowUnsafeApiCalls;

    /** @var array  */
    protected array $dependencies = [
        Security::class
    ];

    /**
     * apiCallerConfigurations constructor.
     */
    public function __construct()
    {
        $this->allowUnsafeApiCalls = filter_var(
            getenv('ALLOW_UNSAFE_API_CALLS'),
            FILTER_VALIDATE_BOOLEAN
        );
    }

    /**
     * @return bool
     */
    public function getAllowUnsafeApiCalls() : bool
    {
        return $this->allowUnsafeApiCalls;
    }
}