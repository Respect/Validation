<?php

namespace Respect\Validation\Exceptions;

class HasAttributeException extends ValidationException
{
    const INVALID_HAS_ATTRIBUTE= 'HasAttribute_1';
    const INVALID_HAS_ATTRIBUTE_RELATED = 'HasAttribute_2';
    public static $defaultTemplates = array(
        self::INVALID_HAS_ATTRIBUTE => '"%2$s" is not present',
        self::INVALID_HAS_ATTRIBUTE_RELATED => '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $hasTheAttribute)
    {
        if (!$hasTheAttribute)
            return self::INVALID_HAS_ATTRIBUTE;
        else
            return self::INVALID_HAS_ATTRIBUTE_RELATED;
    }

}