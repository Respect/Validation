<?php

namespace Respect\Validation\Exceptions;

class NoWhitespaceException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must not contain whitespace',
    );

}