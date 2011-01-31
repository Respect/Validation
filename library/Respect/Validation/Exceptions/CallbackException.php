<?php

namespace Respect\Validation\Exceptions;

class CallbackException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is invalid',
    );

}