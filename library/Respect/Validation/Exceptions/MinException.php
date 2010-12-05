<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INVALID_MIN= 'Min_1';
    public static $defaultTemplates = array(
        self::INVALID_MIN => '"%s" is lower than %s',
    );

}