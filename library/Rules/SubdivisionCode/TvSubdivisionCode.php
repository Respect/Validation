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
 * Validator for Tuvalu subdivision code.
 *
 * ISO 3166-1 alpha-2: TV
 *
 * @link http://www.geonames.org/TV/administrative-division-tuvalu.html
 */
class TvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'FUN', // Funafuti
        'NIT', // Niutao
        'NKF', // Nukufetau
        'NKL', // Nukulaelae
        'NMA', // Nanumea
        'NMG', // Nanumanga
        'NUI', // Nui
        'VAI', // Vaitupu
    ];

    public $compareIdentical = true;
}
