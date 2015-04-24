<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Malawi country subdivision.
 *
 * ISO 3166-1 alpha-2: MW
 *
 * @link http://www.geonames.org/MW/administrative-division-malawi.html
 */
class MwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'C', // Central
        'N', // Northern
        'S', // Southern
        'BA', // Balaka
        'BL', // Blantyre
        'CK', // Chikwawa
        'CR', // Chiradzulu
        'CT', // Chitipa
        'DE', // Dedza
        'DO', // Dowa
        'KR', // Karonga
        'KS', // Kasungu
        'LI', // Lilongwe
        'LK', // Likoma
        'MC', // Mchinji
        'MG', // Mangochi
        'MH', // Machinga
        'MU', // Mulanje
        'MW', // Mwanza
        'MZ', // Mzimba
        'NB', // Nkhata Bay
        'NE', // Neno
        'NI', // Ntchisi
        'NK', // Nkhotakota
        'NS', // Nsanje
        'NU', // Ntcheu
        'PH', // Phalombe
        'RU', // Rumphi
        'SA', // Salima
        'TH', // Thyolo
        'ZO', // Zomba
    );

    public $compareIdentical = true;
}
