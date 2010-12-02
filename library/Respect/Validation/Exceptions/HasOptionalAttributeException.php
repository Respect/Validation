<?php

namespace Respect\Validation\Exceptions;

class HasOptionalAttributeException extends ValidationException
{
    const INVALID_HAS_ATTRIBUTE= 'HasAttribute_1';
    const INVALID_HAS_ATTRIBUTE_RELATED = 'HasAttribute_2';
    public static $defaultTemplates = array(
        self::INVALID_HAS_ATTRIBUTE => '"%s" is not present',
        self::INVALID_HAS_ATTRIBUTE_RELATED => '"%s" is invalid',
    );

}