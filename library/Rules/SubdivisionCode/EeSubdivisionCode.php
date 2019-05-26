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
 * Validator for Estonia subdivision code.
 *
 * ISO 3166-1 alpha-2: EE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class EeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '37', // Harjumaa
        '39', // Hiiumaa
        '44', // Ida-Virumaa
        '49', // Jõgevamaa
        '51', // Järvamaa
        '57', // Läänemaa
        '59', // Lääne-Virumaa
        '65', // Põlvamaa
        '67', // Pärnumaa
        '70', // Raplamaa
        '74', // Saaremaa
        '78', // Tartumaa
        '82', // Valgamaa
        '84', // Viljandimaa
        '86', // Võrumaa
    ];

    public $compareIdentical = true;
}
