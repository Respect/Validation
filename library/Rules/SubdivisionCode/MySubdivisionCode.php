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
 * Validator for Malaysia subdivision code.
 *
 * ISO 3166-1 alpha-2: MY
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Johor
        '02', // Kedah
        '03', // Kelantan
        '04', // Melaka
        '05', // Negeri Sembilan
        '06', // Pahang
        '07', // Pulau Pinang
        '08', // Perak
        '09', // Perlis
        '10', // Selangor
        '11', // Terengganu
        '12', // Sabah
        '13', // Sarawak
        '14', // Wilayah Persekutuan Kuala Lumpur
        '15', // Wilayah Persekutuan Labuan
        '16', // Wilayah Persekutuan Putrajaya
    ];

    public $compareIdentical = true;
}
