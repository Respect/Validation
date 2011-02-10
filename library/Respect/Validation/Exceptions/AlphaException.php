<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const EXTRA = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must contain only letters (a-z)',
        self::EXTRA => '{{name}} must contain only letters (a-z) and "{{additionalChars}}"'
    );

    public function chooseTemplate()
    {
        return $this->getParam('additionalChars') ? static::STANDARD : static::EXTRA;
    }

}
