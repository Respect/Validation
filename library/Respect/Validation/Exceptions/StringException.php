<?php

namespace Respect\Validation\Exceptions;

class StringException extends ValidationException
{
    const INVALID_STRING= 'String_1';
    public static $defaultTemplates = array(
        self::INVALID_STRING => '"%s" is not a valid string',
    );

}