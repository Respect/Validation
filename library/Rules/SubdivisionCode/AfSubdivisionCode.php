<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Afghanistan subdivision code.
 *
 * ISO 3166-1 alpha-2: AF
 *
 * @link http://www.geonames.org/AF/administrative-division-afghanistan.html
 */
class AfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
    ];

    public $compareIdentical = true;
}
