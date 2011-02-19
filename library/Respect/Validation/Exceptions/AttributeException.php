<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractRelatedException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;
    public static $defaultTemplates = array(
        self::NOT_PRESENT => 'Attribute {{name}} must be present',
        self::INVALID => 'Attribute {{name}} must be valid',
    );

    public function chooseTemplate()
    {
        return $this->getParam('hasReference') ? static::INVALID : static::NOT_PRESENT;
    }

}
