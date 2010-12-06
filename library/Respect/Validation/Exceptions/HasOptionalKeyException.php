<?php

namespace Respect\Validation\Exceptions;

class HasOptionalKeyException extends ValidationException
{
    const INVALID_HAS_KEY_RELATED = 'HasOptionalKey_1';
    public static $defaultTemplates = array(
        self::INVALID_HAS_Key_RELATED => '"%2$s" is invalid',
    );

}