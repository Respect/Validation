<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::BOTH => '"%s" length is not between %d and %d',
        self::LOWER => '"%s" length is lower than %2$d',
        self::GREATER => '"%s" length is greater than %3$d',
    );

    public function chooseTemplate($input, $min, $max)
    {
        if (is_null($min))
            return static::GREATER;
        elseif (is_null($max))
            return static::LOWER;
        else
            return static::BOTH;
    }

}