<?php
namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{
    const INCLUSIVE = 1;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be greater than {{interval}}',
            self::INCLUSIVE => '{{name}} must be greater than or equals {{interval}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be greater than {{interval}}',
            self::INCLUSIVE => '{{name}} must not be greater than or equals {{interval}}',
        ),
    );

    public function chooseTemplate()
    {
        return $this->getParam('inclusive') ? static::INCLUSIVE : static::STANDARD;
    }
}
