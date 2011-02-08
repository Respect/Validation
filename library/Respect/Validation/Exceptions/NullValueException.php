<?php

namespace Respect\Validation\Exceptions;

class NullValueException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be null',
    );

}