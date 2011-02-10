<?php

namespace Respect\Validation\Exceptions;

class InException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be in ({{haystack}})',
    );

}
