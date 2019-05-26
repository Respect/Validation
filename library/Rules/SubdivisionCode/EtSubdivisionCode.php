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
 * Validator for Ethiopia subdivision code.
 *
 * ISO 3166-1 alpha-2: ET
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class EtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AA', // Ādīs Ābeba
        'AF', // Āfar
        'AM', // Āmara
        'BE', // Bīnshangul Gumuz
        'DD', // Dirē Dawa
        'GA', // Gambēla Hizboch
        'HA', // Hārerī Hizb
        'OR', // Oromīya
        'SN', // YeDebub Bihēroch Bihēreseboch na Hizboch
        'SO', // Sumalē
        'TI', // Tigray
    ];

    public $compareIdentical = true;
}
