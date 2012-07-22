<?php

namespace Respect\Validation\Exceptions;

class AlnumException extends AlphaException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only letters (a-z) and digits (0-9)',
            self::EXTRA => '{{name}} must contain only letters (a-z), digits (0-9) and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain letters (a-z) or digits (0-9)',
            self::EXTRA => '{{name}} must not contain letters (a-z), digits (0-9) or "{{additionalChars}}"'
        )
    );

}

