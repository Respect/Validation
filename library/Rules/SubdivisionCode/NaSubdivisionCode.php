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
 * Validator for Namibia subdivision code.
 *
 * ISO 3166-1 alpha-2: NA
 *
 * @link http://www.geonames.org/NA/administrative-division-namibia.html
 */
class NaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'CA', // Caprivi
        'ER', // Erongo
        'HA', // Hardap
        'KA', // Karas
        'KE', // Kavango East
        'KH', // Khomas
        'KU', // Kunene
        'KW', // Kavango West
        'OD', // Otjozondjupa
        'OH', // Omaheke
        'ON', // Oshana
        'OS', // Omusati
        'OT', // Oshikoto
        'OW', // Ohangwena
    ];

    public $compareIdentical = true;
}
