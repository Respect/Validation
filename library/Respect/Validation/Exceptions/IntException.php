<?php

namespace Respect\Validation\Exceptions;

class IntException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not a valid integer number',
    );

}