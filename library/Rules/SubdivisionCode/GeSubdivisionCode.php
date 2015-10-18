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
 * @link http://www.geonames.org/GE/administrative-division-georgia.html
 */
class GeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Abkhazia
        'AJ', // Ajaria
        'GU', // Guria
        'IM', // Imereti
        'KA', // Kakheti
        'KK', // Kvemo Kartli
        'MM', // Mtskheta-Mtianeti
        'RL', // Racha Lechkhumi and Kvemo Svaneti
        'SJ', // Samtskhe-Javakheti
        'SK', // Shida Kartli
        'SZ', // Samegrelo-Zemo Svaneti
        'TB', // Tbilisi
    ];

    public $compareIdentical = true;
}
