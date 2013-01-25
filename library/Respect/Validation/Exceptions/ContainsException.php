<?php
namespace Respect\Validation\Exceptions;

class ContainsException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain the value "{{containsValue}}"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain the value "{{containsValue}}"',
        )
    );
}

