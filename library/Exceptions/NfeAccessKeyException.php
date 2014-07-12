<?php
namespace Respect\Validation\Exceptions;

class NfeAccessKeyException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid NFe access key',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid NFe access key',
        )
    );
}

