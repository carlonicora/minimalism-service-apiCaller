<?php
namespace carlonicora\minimalism\services\apiCaller\configurations;

use carlonicora\minimalism\core\services\abstracts\abstractServiceConfigurations;
use carlonicora\minimalism\services\security\security;

class apiCallerConfigurations extends abstractServiceConfigurations {
    /** @var bool */
    public bool $allowUnsafeApiCalls;

    /** @var array  */
    protected array $dependencies = [
        security::class
    ];

    /**
     * apiCallerConfigurations constructor.
     */
    public function __construct() {
        $this->allowUnsafeApiCalls = getenv('ALLOW_UNSAFE_API_CALLS') ?: false;
    }
}