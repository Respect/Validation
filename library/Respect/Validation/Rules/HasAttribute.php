<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\AttributeNotPresentException;
use Respect\Validation\Rules\All;
use Respect\Validation\Exceptions\ComponentException;

class HasAttribute extends All
{

    protected $attribute = '';

    public function __construct($attribute, $attributeValidator=null)
    {
        if (!is_string($attribute))
            throw new ComponentException(
                'Invalid attribute name'
            );
        $this->attribute = $attribute;
        if (!is_null($attributeValidator))
            $this->addRule($attributeValidator);
    }

    public function validate($input)
    {
        return @property_exists($input, $this->attribute)
        && parent::validate($input->{$this->attribute});
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new AttributeNotPresentException($input, $this->attribute);
        return parent::validate($input->{$this->attribute});
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}