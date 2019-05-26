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
 * Validator for Georgia subdivision code.
 *
 * ISO 3166-1 alpha-2: GE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Abkhazia
        'AJ', // Ajaria
        'GU', // Guria
        'IM', // Imeret’i
        'KA', // Kakhet’i
        'KK', // K’vemo K’art’li
        'MM', // Mts’khet’a-Mt’ianet’i
        'RL', // Racha-Lech’khumi-K’vemo Svanet’i
        'SJ', // Samts’khe-Javakhet’i
        'SK', // Shida K’art’li
        'SZ', // Samegrelo-Zemo Svanet’i
        'TB', // T’bilisi
    ];

    public $compareIdentical = true;
}
