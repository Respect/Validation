<?php

namespace Respect\Validation\Exceptions;

class UppercaseException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be uppercase',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be uppercase',
        )
    );

}

