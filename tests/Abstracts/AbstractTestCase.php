<?php
namespace CarloNicora\Minimalism\Services\ApiCaller\Tests\Abstracts;

use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @return ServicesFactory
     * @throws Exception
     */
    protected function getServices() : ServicesFactory
    {
        return new ServicesFactory();
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function setEnv(string $name, string $value) : void
    {
        putenv($name.'='.$value);
    }

    /**
     * @param $object
     * @param $parameterName
     * @return mixed|null
     */
    protected function getProperty($object, $parameterName)
    {
        try {
            $reflection = new ReflectionClass(get_class($object));
            $property = $reflection->getProperty($parameterName);
            $property->setAccessible(true);
            return $property->getValue($object);
        } catch (ReflectionException $e) {
            return null;
        }
    }

    /**
     * @param $object
     * @param $parameterName
     * @param $parameterValue
     */
    protected function setProperty($object, $parameterName, $parameterValue): void
    {
        try {
            $reflection = new ReflectionClass(get_class($object));
            $property = $reflection->getProperty($parameterName);
            $property->setAccessible(true);
            $property->setValue($object, $parameterValue);
        } catch (ReflectionException $e) {
        }
    }
}