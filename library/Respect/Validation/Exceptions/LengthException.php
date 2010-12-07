<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{
    const INVALID_LENGTH= 'Length_1';
    public static $defaultTemplates = array(
        self::INVALID_LENGTH => '"%s" length is not between %d and %d',
    );

}