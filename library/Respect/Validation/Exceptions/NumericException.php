<?php

namespace Respect\Validation\Exceptions;

class NumericException extends ValidationException
{
    const INVALID_NUMERIC= 'Numeric_1';
    public static $defaultTemplates = array(
        self::INVALID_NUMERIC => '"%s" is not a numeric value',
    );
    
}