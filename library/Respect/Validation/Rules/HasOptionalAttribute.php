<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\HasAttribute;
use \ReflectionProperty;
use \ReflectionException;

class HasOptionalAttribute extends HasAttribute
{

    public function validate($input)
    {
        try {
            return parent::validate(
                $this->getAttributeValue($input)
            );
        } catch (ReflectionException $e) {
            return true;
        }
    }

}