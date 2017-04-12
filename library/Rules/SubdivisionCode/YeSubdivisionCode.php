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
 * Validator for Yemen subdivision code.
 *
 * ISO 3166-1 alpha-2: YE
 *
 * @link http://www.geonames.org/YE/administrative-division-yemen.html
 */
class YeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Abyan
        'AD', // Adan
        'AM', // Amran
        'BA', // Al Bayda
        'DA', // Ad Dali
        'DH', // Dhamar
        'HD', // Hadramawt
        'HJ', // Hajjah
        'HU', // Al Hudaydah
        'IB', // Ibb
        'JA', // Al Jawf
        'LA', // Lahij
        'MA', // Ma'rib
        'MR', // Al Mahrah
        'MW', // Al Mahwit
        'RA', // Raymah
        'SA', // Amanat Al Asimah
        'SD', // Sa'dah
        'SH', // Shabwah
        'SN', // San'a
        'SU', // Socotra
        'TA', // Ta'izz
    ];

    public $compareIdentical = true;
}
