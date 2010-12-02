<?php

namespace Respect\Validation\Exceptions;

class FloatException extends ValidationException
{
    const INVALID_= 'Float_1';
    public static $defaultTemplates = array(
        self::INVALID_ => '"%s" is not a valid float',
    );
    
}