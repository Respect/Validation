<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends ValidationException
{
    const INVALID_INSTANCE= 'Instance_1';
    public static $defaultTemplates = array(
        self::INVALID_INSTANCE => '"%s" is not an instance "%s"',
    );

}