<?php

namespace Respect\Validation\Exceptions;

class CallException extends ValidationException
{
    const INVALID_CALL= 'Call_1';
    public static $defaultTemplates = array(
        self::INVALID_CALL => '"%s" is invalid',
    );

}