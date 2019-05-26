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
 * Validator for Finland subdivision code.
 *
 * ISO 3166-1 alpha-2: FI
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class FiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Ahvenanmaan maakunta
        '02', // Etelä-Karjala
        '03', // Etelä-Pohjanmaa
        '04', // Etelä-Savo
        '05', // Kainuu
        '06', // Kanta-Häme
        '07', // Keski-Pohjanmaa
        '08', // Keski-Suomi
        '09', // Kymenlaakso
        '10', // Lappi
        '11', // Pirkanmaa
        '12', // Pohjanmaa
        '13', // Pohjois-Karjala
        '14', // Pohjois-Pohjanmaa
        '15', // Pohjois-Savo
        '16', // Päijät-Häme
        '17', // Satakunta
        '18', // Uusimaa
        '19', // Varsinais-Suomi
    ];

    public $compareIdentical = true;
}
