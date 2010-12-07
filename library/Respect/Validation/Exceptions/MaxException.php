<?php

namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INVALID_MAX= 'Max_1';
    const INVALID_MAX_INCLUSIVE= 'Max_2';
    public static $defaultTemplates = array(
        self::INVALID_MAX => '%s is greater than %s',
        self::INVALID_MAX_INCLUSIVE => '%s is greater than %s (inclusive)',
    );
    public function chooseTemplate($input, $inclusive)
    {
        if ($inclusive)
            return self::INVALID_MAX;
        else
            return self::INVALID_MAX_INCLUSIVE;
    }

}