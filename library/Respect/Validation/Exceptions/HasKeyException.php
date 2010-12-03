<?php

namespace Respect\Validation\Exceptions;

class HasKeyException extends ValidationException
{
    const INVALID_HAS_KEY= 'HasKey_1';
    const INVALID_HAS_KEY_RELATED = 'HasKey_2';
    public static $defaultTemplates = array(
        self::INVALID_HAS_KEY => '"%2$s" is not present',
        self::INVALID_HAS_KEY_RELATED => '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $hasTheAttribute)
    {
        if (!$hasTheAttribute)
            return self::INVALID_HAS_KEY;
        else
            return self::INVALID_HAS_KEY_RELATED;
    }

}