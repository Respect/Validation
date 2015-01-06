<?php
namespace Respect\Validation\Exceptions;

class YesException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is not considered as "Yes"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is considered as "Yes"',
        ),
    );
}
