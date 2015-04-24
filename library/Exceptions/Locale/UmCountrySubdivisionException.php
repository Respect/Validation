<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * U.S. Minor Outlying Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: UM
 */
class UmCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of U.S. Minor Outlying Islands',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of U.S. Minor Outlying Islands',
        ),
    );
}
