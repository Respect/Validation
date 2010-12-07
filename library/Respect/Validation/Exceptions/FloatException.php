<?php

namespace Respect\Validation\Exceptions;

class FloatException extends ValidationException
{
    const INVALID_FLOAT= 'Float_1';
    public static $defaultTemplates = array(
        self::INVALID_FLOAT => '"%s" is not a valid float',
    );

}