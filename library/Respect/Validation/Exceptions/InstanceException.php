<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be an instance of %s',
    );

}