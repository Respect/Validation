<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * New Zealand country subdivision.
 *
 * ISO 3166-1 alpha-2: NZ
 *
 * @link http://www.geonames.org/NZ/administrative-division-new-zealand.html
 */
class NzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'N', // North Island
        'S', // South Island
        'AUK', // Auckland
        'BOP', // Bay of Plenty
        'CAN', // Canterbury
        'CIT', // Chatham Islands
        'GIS', // Gisborne
        'HKB', // Hawke's Bay
        'MBH', // Marlborough
        'MWT', // Manawatu-Wanganui
        'NSN', // Nelson
        'NTL', // Northland
        'OTA', // Otago
        'STL', // Southland
        'TAS', // Tasman
        'TKI', // Taranaki
        'WGN', // Wellington
        'WKO', // Waikato
        'WTC', // West Coast
    );

    public $compareIdentical = true;
}
