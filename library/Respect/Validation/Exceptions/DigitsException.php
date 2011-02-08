<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must contain only digits (0-9)',
    );

}