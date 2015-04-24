<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bahamas country subdivision.
 *
 * ISO 3166-1 alpha-2: BS
 *
 * @link http://www.geonames.org/BS/administrative-division-bahamas.html
 */
class BsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AK', // Acklins Islands
        'BI', // Bimini and Cat Cay
        'BP', // Black Point
        'BY', // Berry Islands
        'CE', // Central Eleuthera
        'CI', // Cat Island
        'CK', // Crooked Island and Long Cay
        'CO', // Central Abaco
        'CS', // Central Andros
        'EG', // East Grand Bahama
        'EX', // Exuma
        'FP', // City of Freeport
        'GC', // Grand Cay
        'HI', // Harbour Island
        'HT', // Hope Town
        'IN', // Inagua
        'LI', // Long Island
        'MC', // Mangrove Cay
        'MG', // Mayaguana
        'MI', // Moore's Island
        'NE', // North Eleuthera
        'NO', // North Abaco
        'NS', // North Andros
        'RC', // Rum Cay
        'RI', // Ragged Island
        'SA', // South Andros
        'SE', // South Eleuthera
        'SO', // South Abaco
        'SS', // San Salvador
        'SW', // Spanish Wells
        'WG', // West Grand Bahama
        'CO', // Governor’s Harbour
        'FC', // Fresh Creek
        'GT', // Green Turtle Cay
        'HR', // High Rock District
        'KE', // Kemps Bay District
        'MH', // Marsh Harbour District
        'NP', // New Providence
        'RS', // Rock Sound
        'SP', // Sandy Point
    );

    public $compareIdentical = true;
}
