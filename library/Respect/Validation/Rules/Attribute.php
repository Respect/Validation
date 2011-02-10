<?php

namespace Respect\Validation\Rules;

use ReflectionProperty;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Attribute extends AbstractRelated
{

    public function __construct($reference,
        Validatable $referenceValidator=null, $mandatory=true)
    {
        if (!is_string($reference) || empty($reference))
            throw new ComponentException(
                'Invalid attribute/property name'
            );
        parent::__construct($reference, $referenceValidator, $mandatory);
    }

    public function getReferenceValue($input)
    {
        $propertyMirror = new ReflectionProperty($input, $this->reference);
        $propertyMirror->setAccessible(true);
        return $propertyMirror->getValue($input);
    }

    public function hasReference($input)
    {
        return @property_exists($input, $this->reference);
    }

}
