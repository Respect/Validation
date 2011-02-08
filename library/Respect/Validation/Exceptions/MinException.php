<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INCLUSIVE = 1;
    public static $defaultTemplates = array(
        self::STANDARD => '%s must be greater than %s',
        self::INCLUSIVE => '%s must be greater than %s (inclusive)',
    );

    public function cnofigure($name, $min, $inclusive)
    {
        return parent::configure($name, ValidationException::stringify($min),
            $inclusive);//TODO find a better way
    }

    public function chooseTemplate($name, $min, $inclusive)
    {
        return $inclusive ? static::INCLUSIVE : static::STANDARD;
    }

}