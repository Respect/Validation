<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * Guernsey country subdivision.
 *
 * ISO 3166-1 alpha-2: GG
 */
class GgCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of Guernsey',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of Guernsey',
        ),
    );
}
