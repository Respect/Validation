<?php
namespace Respect\Validation\Exceptions;

class PositiveException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be positive',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be positive',
        )
    );
}

