<?php

namespace Respect\Validation\Exceptions;

class DateException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a valid date (format: %s)',
    );

}