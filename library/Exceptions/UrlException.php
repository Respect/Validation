<?php
namespace Respect\Validation\Exceptions;

class UrlException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an URL',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an URL',
        ),
    );
}
