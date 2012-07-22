<?php

namespace Respect\Validation\Exceptions;

class StartsWithException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must start with ({{startValue}})',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not start with ({{startValue}})',
        )
    );

}

