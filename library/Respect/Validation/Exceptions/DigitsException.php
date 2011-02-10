<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends AlphaException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must contain only digits (0-9)',
        self::EXTRA => '{{name}} must contain only digits (0-9) and "{{additionalChars}}"'
    );

}
