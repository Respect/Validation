<?php

namespace Respect\Validation\Exceptions;

class PositiveException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not a positive number',
    );

}