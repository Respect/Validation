<?php

namespace Respect\Validation\Exceptions;

class DateException extends ValidationException
{
    const FORMAT = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be a valid date',
        //TODO reformat to reflect number of digits, so Y-m-d becomes YYYY-mm-dd
        self::FORMAT => '%s must be a valid date in the format %s'
    );

    public function chooseTemplate($name, $format)
    {
        return empty($format) ? static::STANDARD : static::FORMAT;
    }

}