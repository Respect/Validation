<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * Isle of Man country subdivision.
 *
 * ISO 3166-1 alpha-2: IM
 */
class ImCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of Isle of Man',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of Isle of Man',
        ),
    );
}
