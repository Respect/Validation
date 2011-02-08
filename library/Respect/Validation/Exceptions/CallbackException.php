<?php

namespace Respect\Validation\Exceptions;

class CallbackException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be valid',
    );

}