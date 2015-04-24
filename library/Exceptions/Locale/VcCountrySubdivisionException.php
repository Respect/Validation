<?php

namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\CountrySubdivisionException;

/**
 * Saint Vincent and the Grenadines country subdivision.
 *
 * ISO 3166-1 alpha-2: VC
 */
class VcCountrySubdivisionException extends CountrySubdivisionException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a country subdivision of Saint Vincent and the Grenadines',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a country subdivision of Saint Vincent and the Grenadines',
        ),
    );
}
