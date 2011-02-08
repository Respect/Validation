<?php

namespace Respect\Validation\Exceptions;

class FloatException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be a float number',
    );

}