<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\HasAttribute;
use Respect\Validation\Exceptions\HasOptionalAttributeException;
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

    public function assert($input)
    {
        try {
            parent::assert(
                    $this->getAttributeValue($input)
            );
        } catch (ReflectionException $e) {
            return true;
        } catch (ValidationException $e) {
            throw $this
                ->getException()
                ->setParams($input, $this->attribute);
        }
        return true;
    }

    public function createException()
    {
        return new HasOptionalAttributeException;
    }

}