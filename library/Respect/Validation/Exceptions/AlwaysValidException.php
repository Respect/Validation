<?php
namespace Respect\Validation\Exceptions;

class AlwaysValidException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is always valid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is always invalid',
        )
    );
}

