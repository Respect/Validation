<?php

namespace Respect\Validation\Exceptions;

class HasKeyException extends ValidationException
{
    const INVALID_HAS_KEY= 'HasKey_1';
    const INVALID_HAS_KEY_RELATED = 'HasKey_2';
    public static $defaultTemplates = array(
        self::INVALID_HAS_KEY => '"%s" is not present',
        self::INVALID_HAS_KEY_RELATED => '"%s" is invalid',
    );

}