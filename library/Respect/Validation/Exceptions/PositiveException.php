<?php

namespace Respect\Validation\Exceptions;

class PositiveException extends ValidationException
{
    const INVALID_POSITIVE= 'Positive_1';
    public static $defaultTemplates = array(
        self::INVALID_POSITIVE => '%d is not a positive number',
    );

}