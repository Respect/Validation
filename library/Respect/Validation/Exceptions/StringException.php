<?php
namespace Respect\Validation\Exceptions;

class StringException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a string',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be string',
        )
    );
}

