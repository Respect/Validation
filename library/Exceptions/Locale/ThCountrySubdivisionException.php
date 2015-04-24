<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * Thailand country subdivision.
 *
 * ISO 3166-1 alpha-2: TH
 */
class ThCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of Thailand',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of Thailand',
        ),
    );
}
