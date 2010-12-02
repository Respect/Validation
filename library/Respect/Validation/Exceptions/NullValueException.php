<?php

namespace Respect\Validation\Exceptions;

class NullValueException extends ValidationException
{
    const INVALID_NULL_VALUE= 'NullValue_1';
    public static $defaultTemplates = array(
        self::INVALID_NULL_VALUE => '"%s" is not a null value',
    );
    
}