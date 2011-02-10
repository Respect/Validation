<?php

namespace Respect\Validation\Exceptions;

class NumericException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be numeric',
    );

}
