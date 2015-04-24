<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Nepal country subdivision.
 *
 * ISO 3166-1 alpha-2: NP
 *
 * @link http://www.geonames.org/NP/administrative-division-nepal.html
 */
class NpCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Madhyamanchal
        '2', // Madhya Pashchimanchal
        '3', // Pashchimanchal
        '4', // Purwanchal
        '5', // Sudur Pashchimanchal
        'BA', // Bagmati
        'BH', // Bheri
        'DH', // Dhawalagiri
        'GA', // Gandaki
        'JA', // Janakpur
        'KA', // Karnali
        'KO', // Kosi
        'LU', // Lumbini
        'MA', // Mahakali
        'ME', // Mechi
        'NA', // Narayani
        'RA', // Rapti
        'SA', // Sagarmatha
        'SE', // Seti
    );

    public $compareIdentical = true;
}
