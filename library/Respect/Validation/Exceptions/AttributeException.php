<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractRelatedException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;
    public static $defaultTemplates = array(
        self::NOT_PRESENT => '%1$s must be present',
        self::INVALID => 'Attribute %2$s must be valid on %1$s',
    );

    public function chooseTemplate($name, $attributeName, $hasTheAttribute)
    {
        return $hasTheAttribute ? static::INVALID : static::NOT_PRESENT;
    }

}