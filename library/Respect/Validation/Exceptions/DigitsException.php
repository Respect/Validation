<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends ValidationException
{
    const INVALID_DIGITS= 'Digits_1';
    public static $defaultTemplates = array(
        self::INVALID_DIGITS => '"%s" does not contain only digits',
    );

}