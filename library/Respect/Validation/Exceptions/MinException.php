<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INCLUSIVE = 1;

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be greater than {{minValue}}',
        self::INCLUSIVE => '{{name}} must be greater than or equals {{minValue}}',
    );

    public function chooseTemplate()
    {
        return $this->getParam('inclusive') ? static::INCLUSIVE : static::STANDARD;
    }

}
