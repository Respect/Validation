<?php

namespace Respect\Validation\Exceptions;

class StartsWithException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must start with ({{startValue}})',
    );

}
