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
 * Validator for Oman subdivision code.
 *
 * ISO 3166-1 alpha-2: OM
 *
 * @link http://www.geonames.org/OM/administrative-division-oman.html
 */
class OmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BJ', // Al Batinah South
        'BS', // Shamāl al Bāţinah
        'BU', // Al Buraymī
        'DA', // Ad Dakhiliyah
        'MA', // Masqat
        'MU', // Musandam
        'SJ', // Ash Sharqiyah South
        'SS', // Shamāl ash Sharqīyah
        'WU', // Al Wusta
        'ZA', // Az Zahirah
        'ZU', // Zufar
    ];

    public $compareIdentical = true;
}
