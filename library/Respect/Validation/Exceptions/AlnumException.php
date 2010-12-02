<?php

namespace Respect\Validation\Exceptions;

class AlnumException extends ValidationException
{
    const INVALID_ALNUM = 'Alnum_1';
    const INVALID_ALNUM_CHARS = 'Alnum_2';
    public static $defaultTemplates = array(
        self::INVALID_ALNUM => '"%s" does not contain only letters and digits',
        self::INVALID_ALNUM_CHARS => '"%s" does not contain only letters, digits and "%s"'
    );

}