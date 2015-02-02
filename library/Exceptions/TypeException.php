<?php
namespace Respect\Validation\Exceptions;

class TypeException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be {{type}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be {{type}}',
        ),
    );
}
