<?php

namespace Respect\Validation\Exceptions;

class ReadableException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be readable',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be readable',
        )
    );

}
