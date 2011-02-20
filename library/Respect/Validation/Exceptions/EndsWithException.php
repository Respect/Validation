<?php

namespace Respect\Validation\Exceptions;

class EndsWithException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must end with ({{endValue}})',
    );

}
