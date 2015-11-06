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
 * Validator for Egypt subdivision code.
 *
 * ISO 3166-1 alpha-2: EG
 *
 * @link http://www.geonames.org/EG/administrative-division-egypt.html
 */
class EgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ALX', // Al Iskandariyah
        'ASN', // Aswan
        'AST', // Asyut
        'BA', // Al Bahr al Ahmar
        'BH', // Al Buhayrah
        'BNS', // Bani Suwayf
        'C', // Al Qahirah
        'DK', // Ad Daqahliyah
        'DT', // Dumyat
        'FYM', // Al Fayyum
        'GH', // Al Gharbiyah
        'GZ', // Al Jizah
        'IS', // Al Isma'iliyah
        'JS', // Janub Sina'
        'KB', // Al Qalyubiyah
        'KFS', // Kafr ash Shaykh
        'KN', // Qina
        'LX', // Al Uqşur
        'MN', // Al Minya
        'MNF', // Al Minufiyah
        'MT', // Matruh
        'PTS', // Bur Sa'id
        'SHG', // Suhaj
        'SHR', // Ash Sharqiyah
        'SIN', // Shamal Sina'
        'SUZ', // As Suways
        'WAD', // Al Wadi al Jadid
        'HU', // Helwan
        'SU', // As Sādis min Uktūbar
    ];

    public $compareIdentical = true;
}
