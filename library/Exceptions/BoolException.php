<?php
namespace Respect\Validation\Exceptions;

class BoolException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a boolean',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a boolean',
        )
    );
}

