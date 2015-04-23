<?php

namespace Respect\Validation\Exceptions;

class CountryException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country in ISO 3166-1 {{set}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country in ISO 3166-1 {{set}}',
        ),
    );
}
