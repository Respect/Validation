<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractRelatedException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;
    public static $defaultTemplates = array(
        self::NOT_PRESENT => '%1$s is not present',
        self::INVALID => '%1$s is invalid',
    );

    public function chooseTemplate($input, $attributeName, $hasTheAttribute)
    {
        return $hasTheAttribute ? static::INVALID : static::NOT_PRESENT;
    }

}