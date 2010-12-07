<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INVALID_MIN= 'Min_1';
    const INVALID_MIN_INCLUSIVE= 'Min_2';
    public static $defaultTemplates = array(
        self::INVALID_MIN => '%s is lower than %s',
        self::INVALID_MIN_INCLUSIVE => '%s is lower than %s (inclusive)',
    );

    public function chooseTemplate($input, $inclusive)
    {
        if ($inclusive)
            return self::INVALID_MIN;
        else
            return self::INVALID_MIN_INCLUSIVE;
    }

}