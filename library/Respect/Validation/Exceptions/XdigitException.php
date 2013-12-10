<?php
namespace Respect\Validation\Exceptions;

class XdigitException extends AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} contain only hexadecimal digits',
            self::EXTRA => '{{name}} contain only hexadecimal digits and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain hexadecimal digits',
            self::EXTRA => '{{name}} must not contain hexadecimal digits or "{{additionalChars}}"'
        )
    );
}

