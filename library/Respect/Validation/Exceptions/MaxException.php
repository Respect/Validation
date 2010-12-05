<?php

namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INVALID_MAX= 'Max_1';
    public static $defaultTemplates = array(
        self::INVALID_MAX => '"%s" is greater than %s',
    );

}