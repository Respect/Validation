<?php
namespace Respect\Validation\Exceptions;

class TrueException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is not considered as "True"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is considered as "True"',
        ),
    );
}
