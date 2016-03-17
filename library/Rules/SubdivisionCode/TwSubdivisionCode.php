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
 * Validator for Taiwan subdivision code.
 *
 * ISO 3166-1 alpha-2: TW
 *
 * @link http://www.geonames.org/TW/administrative-division-taiwan.html
 */
class TwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'CHA', // Changhua
        'CYI', // Chiayi
        'CYQ', // Chiayi
        'HSQ', // Hsinchu
        'HSZ', // Hsinchu
        'HUA', // Hualien
        'ILA', // Ilan
        'KEE', // Keelung
        'KHH', // Kaohsiung
        'MIA', // Miaoli
        'NAN', // Nantou
        'PEN', // Penghu
        'PIF', // Pingtung
        'TAO', // Taoyuan
        'TNN', // Tainan
        'TPE', // Taipei
        'TPQ', // New Taipei
        'TTT', // Taitung
        'TXG', // Taichung
        'YUN', // Yunlin
        'TXQ', // Taichung County
    ];

    public $compareIdentical = true;
}
