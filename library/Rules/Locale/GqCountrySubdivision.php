<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Equatorial Guinea country subdivision.
 *
 * ISO 3166-1 alpha-2: GQ
 *
 * @link http://www.geonames.org/GQ/administrative-division-equatorial-guinea.html
 */
class GqCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'C', // Región Continental
        'I', // Región Insular
        'AN', // Provincia Annobon
        'BN', // Provincia Bioko Norte
        'BS', // Provincia Bioko Sur
        'CS', // Provincia Centro Sur
        'KN', // Provincia Kie-Ntem
        'LI', // Provincia Litoral
        'WN', // Provincia Wele-Nzas
    );

    public $compareIdentical = true;
}
