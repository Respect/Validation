<?php

namespace Respect\Validation\Exceptions;

class XdigitsException extends AlphaException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only hexadecimal digits (0-9a-fA-F)',
            self::EXTRA => '{{name}} must contain only hexadecimal digits (0-9a-fA-F) and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain hexadecimal digits (0-9a-fA-F)',
            self::EXTRA => '{{name}} must not contain digits (0-9a-fA-F) or "{{additionalChars}}"'
        )
    );

}
