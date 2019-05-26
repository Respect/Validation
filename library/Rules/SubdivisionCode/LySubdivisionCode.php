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
 * Validator for Libya subdivision code.
 *
 * ISO 3166-1 alpha-2: LY
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class LySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Banghāzī
        'BU', // Al Buţnān
        'DR', // Darnah
        'GT', // Ghāt
        'JA', // Al Jabal al Akhḑar
        'JB', // Jaghbūb
        'JG', // Al Jabal al Gharbī
        'JI', // Al Jifārah
        'JU', // Al Jufrah
        'KF', // Al Kufrah
        'MB', // Al Marqab
        'MI', // Mişrātah
        'MJ', // Al Marj
        'MQ', // Murzuq
        'NL', // Nālūt
        'NQ', // An Nuqaţ al Khams
        'SB', // Sabhā
        'SR', // Surt
        'TB', // Ţarābulus
        'WA', // Al Wāḩāt
        'WD', // Wādī al Ḩayāt
        'WS', // Wādī ash Shāţiʾ
        'ZA', // Az Zāwiyah
    ];

    public $compareIdentical = true;
}
