<?php

namespace Respect\Validation\Exceptions;

class EmailException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be valid email',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an email',
        )
    );

}