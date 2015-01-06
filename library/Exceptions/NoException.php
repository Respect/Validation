<?php
namespace Respect\Validation\Exceptions;

class NoException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is not considered as "No"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is considered as "No"',
        ),
    );
}
