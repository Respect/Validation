<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::BOTH => '%s must be between %s and %s',
        self::LOWER => '%s must be greater than %2$s',
        self::GREATER => '%s must be lower than %3$s',
    );

    public function configure($name, $min, $max)
    {
        return parent::configure(
            $name, ValidationException::stringify($min), //TODO find a better way
            ValidationException::stringify($max)
        );
    }

    public function chooseTemplate($name, $min, $max)
    {
        if (is_null($min))
            return static::GREATER;
        elseif (is_null($max))
            return static::LOWER;
        else
            return static::BOTH;
    }

}