<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{
    const STANDARD = 0;
    const NAMED = 1;
    public static $defaultTemplates = array(
        self::STANDARD => 'The value must not be empty',
        self::NAMED => '%s must not be empty',
    );

    public function chooseTemplate($name)
    {
        return empty($name) ? static::STANDARD : static::NAMED;
    }

}