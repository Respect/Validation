<?php
namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\BicException;

class GermanBicException extends BicException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a german BIC',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a german BIC',
        )
    );
}
