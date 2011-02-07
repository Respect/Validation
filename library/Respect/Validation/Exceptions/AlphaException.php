<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const EXTRA = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" does not contain only letters',
        self::EXTRA => '"%s" does not contain only letters and "%s"'
    );

    public function chooseTemplate($input, $additionalCharacters=null)
    {
        return empty($additionalCharacters) ? static::NORMAL : static::EXTRA;
    }

}