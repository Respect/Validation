<?php

namespace Respect\Validation\Exceptions;

class ExecutableException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an executable file',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an executable file',
        ),
    );
}
