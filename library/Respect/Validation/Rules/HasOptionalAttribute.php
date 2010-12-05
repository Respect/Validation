<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\HasOptionalAttributeException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use \ReflectionProperty;
use \ReflectionException;

class HasOptionalAttribute extends AllOf
{

    public function __construct($attribute, Validatable $attributeValidator=null)
    {
        if (!is_string($attribute) || empty($attribute))
            throw new ComponentException(
                'Invalid attribute name'
            );
        $this->attribute = $attribute;
        if (!is_null($attributeValidator))
            $this->addRule($attributeValidator);
    }

    protected function getAttributeValue($input)
    {
        $propertyMirror = new ReflectionProperty($input, $this->attribute);
        $propertyMirror->setAccessible(true);
        return $propertyMirror->getValue($input);
    }

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
            throw $this->getException() ? : HasOptionalAttributeException::create()
                    ->addRelated($e)
                    ->configure($input, $this->attribute, true);
        }
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}