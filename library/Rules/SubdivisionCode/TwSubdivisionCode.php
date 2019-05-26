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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class TwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'CHA', // Changhua
        'CYI', // Chiay City
        'CYQ', // Chiayi
        'HSQ', // Hsinchu
        'HSZ', // Hsinchui City
        'HUA', // Hualien
        'ILA', // Ilan
        'KEE', // Keelung City
        'KHH', // Kaohsiung City
        'KHQ', // Kaohsiung
        'MIA', // Miaoli
        'NAN', // Nantou
        'PEN', // Penghu
        'PIF', // Pingtung
        'TAO', // Taoyuan
        'TNN', // Tainan City
        'TNQ', // Tainan
        'TPE', // Taipei City
        'TPQ', // Taipei
        'TTT', // Taitung
        'TXG', // Taichung City
        'TXQ', // Taichung
        'YUN', // Yunlin
    ];

    public $compareIdentical = true;
}
