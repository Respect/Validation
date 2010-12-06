<?php

namespace Respect\Validation\Exceptions;

class ArrException extends ValidationException
{
    const INVALID_ARR = 'Arr_1';
    public static $defaultTemplates = array(
        self::INVALID_ARR => '"%s" is not an array',
    );

}