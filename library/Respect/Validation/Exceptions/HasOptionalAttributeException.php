<?php

namespace Respect\Validation\Exceptions;

class HasOptionalAttributeException extends ValidationException
{
    const INVALID_HAS_ATTRIBUTE_RELATED = 'HasOptionalAttribute_2';
    public static $defaultTemplates = array(
        self::INVALID_HAS_ATTRIBUTE_RELATED => '"%2$s" is invalid',
    );

}