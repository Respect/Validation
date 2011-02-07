<?php

namespace Respect\Validation\Exceptions;

class DateException extends ValidationException
{
    const FORMAT = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not a valid date',
        self::FORMAT => '"%s" is not a valid date (format: %s)'
    );

    public function chooseTemplate($input, $format)
    {
        return empty($format) ? static::STANDARD : static::FORMAT;
    }

}