<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" does not contain only digits',
    );

}