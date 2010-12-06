<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\HasAttributeException;
use Respect\Validation\Exceptions\ValidationException;
use \ReflectionProperty;

class HasAttribute extends AbstractRelated
{
    const IS_OPTIONAL = false;

    protected function hasReference($input)
    {
        return property_exists($input, $this->reference);
    }

    protected function getReferenceValue($input)
    {
        $propertyMirror = new ReflectionProperty($input, $this->reference);
        $propertyMirror->setAccessible(true);
        return $propertyMirror->getValue($input);
    }

    protected function createException()
    {
        return HasAttributeException::create();
    }

}