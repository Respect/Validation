<?php
namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{
    const STANDARD = 0;
    const NAMED = 1;
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'The value must not be empty',
            self::NAMED => '{{name}} must not be empty',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'The value must be empty',
            self::NAMED => '{{name}} must be empty',
        )
    );

    public function chooseTemplate()
    {
        return $this->getName() == "" ? static::STANDARD : static::NAMED;
    }
}

