<?php
namespace Respect\Validation\Exceptions;

class GraphException extends AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only graphical characters',
            self::EXTRA => '{{name}} must contain only graphical characters and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain graphical characters',
            self::EXTRA => '{{name}} must not contain graphical characters or "{{additionalChars}}"'
        )
    );
}

