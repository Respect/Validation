<?php

namespace Respect\Validation\Exceptions;

class CallbackException extends ValidationException
{
    const INVALID_CALLBACK= 'Callback_1';
    public static $defaultTemplates = array(
        self::INVALID_CALLBACK => '"%s" is invalid',
    );

}