<?php
namespace Respect\Validation\Exceptions;

class FloatException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a float number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a float number',
        )
    );
}

