<?php
namespace Respect\Validation\Exceptions;

class PostalCodeException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid postal code',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid postal code',
        ),
    );
}
