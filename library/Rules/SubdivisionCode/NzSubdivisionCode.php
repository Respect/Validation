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
 * Validator for New Zealand subdivision code.
 *
 * ISO 3166-1 alpha-2: NZ
 *
 * @link http://www.geonames.org/NZ/administrative-division-new-zealand.html
 */
class NzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
    ];

    public $compareIdentical = true;
}
