<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * Svalbard and Jan Mayen country subdivision.
 *
 * ISO 3166-1 alpha-2: SJ
 */
class SjCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of Svalbard and Jan Mayen',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of Svalbard and Jan Mayen',
        ),
    );
}
