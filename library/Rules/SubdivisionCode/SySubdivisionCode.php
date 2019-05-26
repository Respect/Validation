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
 * Validator for Syria subdivision code.
 *
 * ISO 3166-1 alpha-2: SY
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DI', // Dimashq
        'DR', // Dar'a
        'DY', // Dayr az Zawr
        'HA', // Al Hasakah
        'HI', // Homs
        'HL', // Halab
        'HM', // Hamah
        'ID', // Idlib
        'LA', // Al Ladhiqiyah
        'QU', // Al Qunaytirah
        'RA', // Ar Raqqah
        'RD', // Rif Dimashq
        'SU', // As Suwayda'
        'TA', // Tartus
    ];

    public $compareIdentical = true;
}
