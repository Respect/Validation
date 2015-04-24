<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * South Georgia and the South Sandwich Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: GS
 */
class GsCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of South Georgia and the South Sandwich Islands',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of South Georgia and the South Sandwich Islands',
        ),
    );
}
