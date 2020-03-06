<?php

namespace App\Tests;

/**
 * Class PrivatePropertyManipulator
 *
 * @package App\Tests
 */
trait PrivatePropertyManipulator
{
    public function setByReflection($object, string $property, $value): void
    {
        $reflectionProperty = $this->getAccessibleReflectionProperty($object, $property);
        $reflectionProperty->setValue($object, $value);
    }

    public function getByReflection($object, $property)
    {
        $reflectionProperty = $this->getAccessibleReflectionProperty($object, $property);

        return $reflectionProperty->getValue($object);
    }

    private function getAccessibleReflectionProperty($object, $property): \ReflectionProperty
    {
        $reflectionProperty = new \ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty;
    }
}
