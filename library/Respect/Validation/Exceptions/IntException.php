<?php

namespace Respect\Validation\Exceptions;

class IntException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be an integer number',
    );

}