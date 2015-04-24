<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Mongolia country subdivision.
 *
 * ISO 3166-1 alpha-2: MN
 *
 * @link http://www.geonames.org/MN/administrative-division-mongolia.html
 */
class MnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '035', // Orhon
        '037', // Darhan uul
        '039', // Hentiy
        '041', // Hovsgol
        '043', // Hovd
        '046', // Uvs
        '047', // Tov
        '049', // Selenge
        '051', // Suhbaatar
        '053', // Omnogovi
        '055', // Ovorhangay
        '057', // Dzavhan
        '059', // DundgovL
        '061', // Dornod
        '063', // Dornogov
        '064', // Govi-Sumber
        '065', // Govi-Altay
        '067', // Bulgan
        '069', // Bayanhongor
        '071', // Bayan-Olgiy
        '073', // Arhangay
        '1', // Ulanbaatar
    );

    public $compareIdentical = true;
}
