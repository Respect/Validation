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
 * Validator for Nauru subdivision code.
 *
 * ISO 3166-1 alpha-2: NR
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class NrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Aiwo
        '02', // Anabar
        '03', // Anetan
        '04', // Anibare
        '05', // Baiti
        '06', // Boe
        '07', // Buada
        '08', // Denigomodu
        '09', // Ewa
        '10', // Ijuw
        '11', // Meneng
        '12', // Nibok
        '13', // Uaboe
        '14', // Yaren
    ];

    public $compareIdentical = true;
}
