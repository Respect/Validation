<?php

namespace Respect\Validation\Exceptions;

class InException extends ValidationException
{
    const INVALID_IN = 'In_1';
    public static $defaultTemplates = array(
        self::INVALID_IN => '"%s" is not in %s',
    );

}