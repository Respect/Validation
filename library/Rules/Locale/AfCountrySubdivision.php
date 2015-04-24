<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Afghanistan country subdivision.
 *
 * ISO 3166-1 alpha-2: AF
 *
 * @link http://www.geonames.org/AF/administrative-division-afghanistan.html
 */
class AfCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BAL', // Balkh province
        'BAM', // Bamian province
        'BDG', // Badghis province
        'BDS', // Badakhshan province
        'BGL', // Baghlan province
        'DAY', // Dāykundī
        'FRA', // Farah province
        'FYB', // Faryab province
        'GHA', // Ghazni province
        'GHO', // Ghowr province
        'HEL', // Helmand province
        'HER', // Herat province
        'JOW', // Jowzjan province
        'KAB', // Kabul province
        'KAN', // Kandahar province
        'KAP', // Kapisa province
        'KDZ', // Kondoz province
        'KHO', // Khost province
        'KNR', // Konar province
        'LAG', // Laghman province
        'LOW', // Lowgar province
        'NAN', // Nangrahar province
        'NIM', // Nimruz province
        'NUR', // Nurestan province
        'ORU', // Oruzgan province
        'PAN', // Panjshir
        'PAR', // Parwan province
        'PIA', // Paktia province
        'PKA', // Paktika province
        'SAM', // Samangan province
        'SAR', // Sar-e Pol province
        'TAK', // Takhar province
        'WAR', // Wardak province
        'ZAB', // Zabol province
    );

    public $compareIdentical = true;
}
