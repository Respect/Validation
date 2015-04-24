<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Poland country subdivision.
 *
 * ISO 3166-1 alpha-2: PL
 *
 * @link http://www.geonames.org/PL/administrative-division-poland.html
 */
class PlCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DS', // Dolnoslaskie
        'KP', // Kujawsko-Pomorskie
        'LB', // Lubuskie
        'LD', // Lodzkie
        'LU', // Lubelskie
        'MA', // Malopolskie
        'MZ', // Mazowieckie
        'OP', // Opolskie
        'PD', // Podlaskie
        'PK', // Podkarpackie
        'PM', // Pomorskie
        'SK', // Swietokrzyskie
        'SL', // Slaskie
        'WN', // Warminsko-Mazurskie
        'WP', // Wielkopolskie
        'ZP', // Zachodniopomorskie
    );

    public $compareIdentical = true;
}
