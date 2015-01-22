<?php
namespace Respect\Validation\Exceptions;

class FalseException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is not considered as "False"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is considered as "False"',
        ),
    );
}
