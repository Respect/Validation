<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be negative',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be negative',
        )
    );

}
