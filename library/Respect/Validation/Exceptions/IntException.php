<?php
namespace Respect\Validation\Exceptions;

class IntException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an integer number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an integer number',
        )
    );
}

