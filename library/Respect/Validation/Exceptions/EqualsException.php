<?php

namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{
    const INVALID_EQUALS= 'Equals_1';
    const INVALID_IDENTICAL= 'Equals_2';
    public static $defaultTemplates = array(
        self::INVALID_EQUALS => '"%s" is not equals "%s"',
        self::INVALID_IDENTICAL => '"%s" is not identical to "%s"',
    );

    public function chooseTemplate($input, $equals, $identical)
    {
        if ($identical)
            return self::INVALID_IDENTICAL;
        else
            return self::INVALID_EQUALS;
    }

}