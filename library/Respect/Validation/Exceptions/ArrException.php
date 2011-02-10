<?php

namespace Respect\Validation\Exceptions;

class ArrException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be an array',
    );

}
