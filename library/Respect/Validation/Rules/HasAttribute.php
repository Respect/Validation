<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\AttributeNotPresentException;
use Respect\Validation\Rules\All;
use Respect\Validation\Exceptions\ComponentException;

class HasAttribute extends All
{
    const MSG_ATTRIBUTE_NOT_PRESENT = 'HasAttribute_1';
    protected $messageTemplates = array(
        self::MSG_ATTRIBUTE_NOT_PRESENT => 'Object does not have the attribute %s'
    );
    protected $attribute = '';

    public function __construct($attribute, $attributeValidator=null)
    {
        if (!is_string($attribute))
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid attribute name',
                    $this->getStringRepresentation($attribute)
                )
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
            throw new AttributeNotPresentException(
                sprintf(
                    $this->getMessageTemplate(self::MSG_ATTRIBUTE_NOT_PRESENT),
                    $this->attribute
                )
            );
        return parent::validate($input->{$this->attribute});
    }

}