<?php

namespace Respect\Validation\Exceptions;

class StringException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be a string',
    );

}