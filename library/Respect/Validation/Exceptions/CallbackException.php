<?php

namespace Respect\Validation\Exceptions;

class CallbackException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be valid',
    );

}
