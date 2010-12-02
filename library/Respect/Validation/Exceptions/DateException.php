<?php

namespace Respect\Validation\Exceptions;

class DateException extends ValidationException
{
    const INVALID_DATE= 'Date_1';
    public static $defaultTemplates = array(
        self::INVALID_DATE => '"%s" is not a valid date (format: %s)',
    );

}