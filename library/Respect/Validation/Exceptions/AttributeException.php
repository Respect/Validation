<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends ValidationException
{
    const INVALID_ATTRIBUTE= 'Attribute_1';
    const INVALID_ATTRIBUTE_RELATED = 'Attribute_2';
    public static $defaultTemplates = array(
        self::INVALID_ATTRIBUTE => '"%2$s" is not present',
        self::INVALID_ATTRIBUTE_RELATED => '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $hasTheAttribute)
    {
        if (!$hasTheAttribute)
            return self::INVALID_ATTRIBUTE;
        else
            return self::INVALID_ATTRIBUTE_RELATED;
    }

}