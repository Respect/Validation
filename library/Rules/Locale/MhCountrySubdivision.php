<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Marshall Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: MH
 *
 * @link http://www.geonames.org/MH/administrative-division-marshall-islands.html
 */
class MhCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'L', // Ralik chain
        'T', // Ratak chain
        'ALK', // Ailuk
        'ALL', // Ailinglaplap
        'ARN', // Arno
        'AUR', // Aur
        'EBO', // Ebon
        'ENI', // Enewetak
        'JAB', // Jabat
        'JAL', // Jaluit
        'KIL', // Kili
        'KWA', // Kwajalein
        'LAE', // Lae
        'LIB', // Lib
        'LIK', // Likiep
        'MAJ', // Majuro
        'MAL', // Maloelap
        'MEJ', // Mejit
        'MIL', // Mili
        'NMK', // Namorik
        'NMU', // Namu
        'RON', // Rongelap
        'UJA', // Ujae
        'UTI', // Utirik
        'WTH', // Wotho
        'WTJ', // Wotje
    );

    public $compareIdentical = true;
}
