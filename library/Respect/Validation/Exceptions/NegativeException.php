<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be negative',
    );

}
