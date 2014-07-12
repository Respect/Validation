<?php
namespace Respect\Validation\Exceptions;

class TldException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT =>array(
            self::STANDARD => '{{name}} must be a valid top-level domain name',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid top-level domain name',
        )
    );
}

