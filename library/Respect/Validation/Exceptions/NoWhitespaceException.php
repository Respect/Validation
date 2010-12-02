<?php

namespace Respect\Validation\Exceptions;

class NoWhitespaceException extends ValidationException
{
    const INVALID_NO_WHITESPACE= 'NoWhitespace_1';
    public static $defaultTemplates = array(
        self::INVALID_NO_WHITESPACE => '"%s" contains whitespace',
    );

}