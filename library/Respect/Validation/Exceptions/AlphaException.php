<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const EXTRA = 1;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only letters (a-z)',
            self::EXTRA => '{{name}} must contain only letters (a-z) and "{{additionalChars}}"'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain letters (a-z)',
            self::EXTRA => '{{name}} must not contain letters (a-z) or "{{additionalChars}}"'
        )
    );

    public function chooseTemplate()
    {
        return $this->getParam('additionalChars') ? static::EXTRA : static::STANDARD;
    }

}

