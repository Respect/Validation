<?php
namespace Respect\Validation\Exceptions;

class InException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be in ({{haystack}})',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be in ({{haystack}})',
        )
    );
}

