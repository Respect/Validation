<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INCLUSIVE = 1;
    public static $defaultTemplates = array(
        self::STANDARD => '%s is lower than %s',
        self::INCLUSIVE => '%s is lower than %s (inclusive)',
    );

    public function chooseTemplate($input, $inclusive)
    {
        return $inclusive ? static::INCLUSIVE : static::STANDARD;
    }

}