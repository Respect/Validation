<?php

namespace Respect\Validation\Exceptions;

class RegexException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must validate against %s',
    );

}