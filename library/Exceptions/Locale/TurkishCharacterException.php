<?php
namespace Respect\Validation\Exceptions\Locale;


use Respect\Validation\Exceptions\ValidationException;

class TurkishCharacterException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must include Turkish characters',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} can not include Turkish characters',
        )
    );
}
