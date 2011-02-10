<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractCompositeException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;
    public static $defaultTemplates = array(
        self::NOT_PRESENT => 'Attribute {{reference}} must be present on {{name}}',
        self::INVALID => 'Attribute {{reference}} must be valid on {{name}}',
    );

    public function chooseTemplate()
    {
        return $this->getParam('hasReference') ? static::INVALID : static::NOT_PRESENT;
    }

}
