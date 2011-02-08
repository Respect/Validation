<?php

namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INCLUSIVE = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be lower than %s',
        self::INCLUSIVE => '%s must be lower than %s (inclusive)',
    );

    public function cnofigure($name, $max, $inclusive)
    {
        return parent::configure($name, ValidationException::stringify($max),
            $inclusive);//TODO find a better way
    }

    public function chooseTemplate($name, $max, $inclusive)
    {
        return $inclusive ? static::INCLUSIVE : static::STANDARD;
    }

}