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
 * Validator for Iraq subdivision code.
 *
 * ISO 3166-1 alpha-2: IQ
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class IqSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Al Anbar
        'AR', // Arbil
        'BA', // Al Basrah
        'BB', // Babil
        'BG', // Baghdad
        'DA', // Dahuk
        'DI', // Diyala
        'DQ', // Dhi Qar
        'KA', // Karbala'
        'MA', // Maysan
        'MU', // Al Muthanna
        'NA', // An Najef
        'NI', // Ninawa
        'QA', // Al Qadisiyah
        'SD', // Salah ad Din
        'SW', // As Sulaymaniyah
        'TS', // At Ta'mim
        'WA', // Wasit
    ];

    public $compareIdentical = true;
}
