<?php
namespace Respect\Validation\Exceptions;

class SpaceException extends AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only space characters',
            self::EXTRA => '{{name}} must contain only space characters and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain space characters',
            self::EXTRA => '{{name}} must not contain space characters or "{{additionalChars}}"'
        )
    );
}

