<?php

namespace Respect\Validation\Exceptions;

class KeyException extends ValidationException
{
    const INVALID_KEY= 'Key_1';
    const INVALID_KEY_RELATED = 'Key_2';
    public static $defaultTemplates = array(
        self::INVALID_KEY => '"%2$s" is not present',
        self::INVALID_KEY_RELATED => '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $TheAttribute)
    {
        if (!$TheAttribute)
            return self::INVALID_KEY;
        else
            return self::INVALID_KEY_RELATED;
    }

}