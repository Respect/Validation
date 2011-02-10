<?php

namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 0;

    public static $defaultTemplates = array(
        self::EQUALS => '{{name}} must be equals {{compareTo}}',
        self::IDENTICAL => '{{name}} must be identical as {{compareTo}}',
    );

    public function chooseTemplate()
    {
        return $this->getParam('identical') ? static::IDENTICAL : static::EQUALS;
    }

}
