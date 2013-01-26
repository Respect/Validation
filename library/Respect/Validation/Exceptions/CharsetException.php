<?php
namespace Respect\Validation\Exceptions;

class CharsetException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be in the {{charset}} charset'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be in the {{charset}} charset'
        )
    );
}

