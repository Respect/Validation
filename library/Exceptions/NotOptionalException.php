<?php

namespace Respect\Validation\Exceptions;

class NotOptionalException extends ValidationException
{
    const STANDARD = 0;
    const NAMED = 1;
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'The value is not optional but required',
            self::NAMED => '{{name}} is not optional but required',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'The value must be an empty string',
            self::NAMED => '{{name}} must be an empty string',
        ),
    );

    public function chooseTemplate()
    {
        return $this->getName() == "" ? static::STANDARD : static::NAMED;
    }
}
