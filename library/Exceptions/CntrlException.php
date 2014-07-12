<?php
namespace Respect\Validation\Exceptions;

class CntrlException extends AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only control characters',
            self::EXTRA => '{{name}} must contain only control characters and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain control characters',
            self::EXTRA => '{{name}} must not contain control characters or "{{additionalChars}}"'
        )
    );
}

