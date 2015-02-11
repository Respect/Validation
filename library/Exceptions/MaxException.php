<?php
namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INCLUSIVE = 1;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be lower than {{interval}}',
            self::INCLUSIVE => '{{name}} must be lower than or equals {{interval}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be lower than {{interval}}',
            self::INCLUSIVE => '{{name}} must not be lower than or equals {{interval}}',
        ),
    );

    public function chooseTemplate()
    {
        return $this->getParam('inclusive') ? static::INCLUSIVE : static::STANDARD;
    }
}
