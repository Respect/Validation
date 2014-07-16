<?php
namespace Respect\Validation\Exceptions;

class RGBColorException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a RGB color',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a RGB color',
        )
    );
}

