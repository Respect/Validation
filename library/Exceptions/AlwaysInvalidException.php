<?php
namespace Respect\Validation\Exceptions;

class AlwaysInvalidException extends ValidationException
{
    const SIMPLE = 0;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is always invalid',
            self::SIMPLE   => '{{name}} is not valid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is always valid',
            self::SIMPLE   => '{{name}} is valid',
        ),
    );
}
