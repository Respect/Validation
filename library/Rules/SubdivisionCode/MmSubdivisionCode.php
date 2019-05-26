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
 * Validator for Myanmar [Burma] subdivision code.
 *
 * ISO 3166-1 alpha-2: MM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Sagaing
        '02', // Bago
        '03', // Magway
        '04', // Mandalay
        '05', // Tanintharyi
        '06', // Yangon
        '07', // Ayeyarwady
        '11', // Kachin
        '12', // Kayah
        '13', // Kayin
        '14', // Chin
        '15', // Mon
        '16', // Rakhine
        '17', // Shan
    ];

    public $compareIdentical = true;
}
