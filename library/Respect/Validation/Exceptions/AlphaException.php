<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const EXTRA = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '%s must contain only letters (a-z)',
        self::EXTRA => '%s must contain only letters (a-z) and "%s"'
    );

    public function chooseTemplate($name, $additionalCharacters=null)
    {
        return empty($additionalCharacters) ? static::STANDARD : static::EXTRA;
    }

}