<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends AlphaException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only digits (0-9)',
            self::EXTRA => '{{name}} must contain only digits (0-9) and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain digits (0-9)',
            self::EXTRA => '{{name}} must not contain digits (0-9) or "{{additionalChars}}"'
        )
    );

}

