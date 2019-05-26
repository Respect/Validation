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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class YeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Abyān
        'AD', // 'Adan
        'AM', // 'Amrān
        'BA', // Al Bayḑā'
        'DA', // Aḑ Ḑāli‘
        'DH', // Dhamār
        'HD', // Ḩaḑramawt
        'HJ', // Ḩajjah
        'IB', // Ibb
        'JA', // Al Jawf
        'LA', // Laḩij
        'MA', // Ma'rib
        'MR', // Al Mahrah
        'MU', // Al Ḩudaydah
        'MW', // Al Maḩwīt
        'RA', // Raymah
        'SD', // Şa'dah
        'SH', // Shabwah
        'SN', // Şan'ā'
        'TA', // Tā'izz
    ];

    public $compareIdentical = true;
}
