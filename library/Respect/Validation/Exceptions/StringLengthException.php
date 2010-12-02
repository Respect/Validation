<?php

namespace Respect\Validation\Exceptions;

class StringLengthException extends ValidationException
{
    const INVALID_LESS= 'StringLength_1';
    const INVALID_MORE= 'StringLength_2';
    public static $defaultTemplates = array(
        self::INVALID_LESS => '"%s" is shorter than the specified minimum of %n characters',
        self::INVALID_MORE => '"%s" is longer than the specified minimum of %n characters',
    );

}