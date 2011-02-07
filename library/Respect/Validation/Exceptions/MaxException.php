<?php

namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INCLUSIVE =1;

    public static $defaultTemplates = array(
        self::STANDARD => '%s is greater than %s',
        self::INCLUSIVE => '%s is greater than %s (inclusive)',
    );

    public function chooseTemplate($input, $inclusive)
    {
        return $inclusive ? static::INCLUSIVE : static::STANDARD;
    }

}