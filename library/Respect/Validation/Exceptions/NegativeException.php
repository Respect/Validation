<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not a negative number',
    );

}