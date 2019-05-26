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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class OmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Al Bāţinah
        'BU', // Al Buraymī
        'DA', // Ad Dākhilīya
        'MA', // Masqaţ
        'MU', // Musandam
        'SH', // Ash Sharqīyah
        'WU', // Al Wusţá
        'ZA', // Az̧ Z̧āhirah
        'ZU', // Z̧ufār
    ];

    public $compareIdentical = true;
}
