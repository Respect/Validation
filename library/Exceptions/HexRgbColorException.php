<?php
namespace Respect\Validation\Exceptions;

class HexRgbColorException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a hex RGB color',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a hex RGB color',
        ),
    );
}
