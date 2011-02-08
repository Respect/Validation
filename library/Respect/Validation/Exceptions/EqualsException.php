<?php

namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 0;

    public static $defaultTemplates = array(
        self::EQUALS => '%s must be equals %s',
        self::IDENTICAL => '%s must be identical as %s',
    );

    public function chooseTemplate($name, $equals, $identical)
    {
        return ($identical) ? static::IDENTICAL : static::EQUALS;
    }

}