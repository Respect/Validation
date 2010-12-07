<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{
    const INVALID_NEGATIVE= 'Negative_1';
    public static $defaultTemplates = array(
        self::INVALID_NEGATIVE => '%d is not a negative number',
    );

}