<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is out of bounds',
    );

}