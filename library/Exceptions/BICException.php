<?php
namespace Respect\Validation\Exceptions;

class BICException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a BIC',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a BIC',
        )
    );
}
