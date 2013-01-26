<?php
namespace Respect\Validation\Exceptions;

class EvenException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an even number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an even number',
        )
    );
}

