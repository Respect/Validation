<?php

namespace Respect\Validation\Exceptions;

class ArrException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be an array',
    );

}