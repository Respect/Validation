<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Trinidad and Tobago country subdivision.
 *
 * ISO 3166-1 alpha-2: TT
 *
 * @link http://www.geonames.org/TT/administrative-division-trinidad-and-tobago.html
 */
class TtCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'ARI', // Arima
        'CHA', // Chaguanas
        'CTT', // Couva/Tabaquite/Talparo
        'DMN', // Diego Martin
        'ETO', // Eastern Tobago
        'PED', // Penal/Debe
        'POS', // Port of Spain
        'PRT', // Princes Town
        'PTF', // Point Fortin
        'RCM', // Mayaro/Rio Claro
        'SFO', // San Fernando
        'SGE', // Sangre Grande
        'SIP', // Siparia
        'SJL', // San Juan/Laventille
        'TUP', // Tunapuna/Piarco
        'WTO', // Tobago
    );

    public $compareIdentical = true;
}
