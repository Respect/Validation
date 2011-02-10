<?php

namespace Respect\Validation\Exceptions;

class CallbackException extends AbstractRelatedException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be valid',
    );

}
