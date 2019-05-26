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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class NzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AUK', // Auckland
        'BOP', // Bay of Plenty
        'CAN', // Canterbury
        'CIT', // Chatham Islands Territory
        'GIS', // Gisborne District
        'HKB', // Hawke's Bay
        'MBH', // Marlborough District
        'MWT', // Manawatu-Wanganui
        'N', // North Island
        'NSN', // Nelson City
        'NTL', // Northland
        'OTA', // Otago
        'S', // South Island
        'STL', // Southland
        'TAS', // Tasman District
        'TKI', // Taranaki
        'WGN', // Wellington
        'WKO', // Waikato
        'WTC', // West Coast
    ];

    public $compareIdentical = true;
}
