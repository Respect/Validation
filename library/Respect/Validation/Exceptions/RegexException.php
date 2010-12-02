<?php

namespace Respect\Validation\Exceptions;

class RegexException extends ValidationException
{
    const INVALID_REGEX= 'Regex_1';
    public static $defaultTemplates = array(
        self::INVALID_REGEX => '"%s" did not validated against the "%s" expression',
    );

}