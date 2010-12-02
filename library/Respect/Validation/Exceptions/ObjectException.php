<?php

namespace Respect\Validation\Exceptions;

class ObjectException extends ValidationException
{
    const INVALID_OBJECT= 'Object_1';
    public static $defaultTemplates = array(
        self::INVALID_OBJECT => '"%s" is not an object',
    );

}