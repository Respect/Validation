<?php

namespace Respect\Validation\Exceptions;

class StringLengthException extends ValidationException
{
    const INVALID_LENGTH= 'StringLength_1';
    public static $defaultTemplates = array(
        self::INVALID_LENGTH => '"%s" length out of bounds',
    );

}