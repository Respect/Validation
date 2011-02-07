<?php

namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 0;

    public static $defaultTemplates = array(
        self::EQUALS => '"%s" is not equals "%s"',
        self::IDENTICAL => '"%s" is not identical to "%s"',
    );

    public function chooseTemplate($input, $equals, $identical)
    {
        return ($identical) ? static::IDENTICAL : static::EQUALS;
    }

}