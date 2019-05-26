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
 * Validator for Lithuania subdivision code.
 *
 * ISO 3166-1 alpha-2: LT
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class LtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AL', // Alytaus Apskritis
        'KL', // Klaipėdos Apskritis
        'KU', // Kauno Apskritis
        'MR', // Marijampolės Apskritis
        'PN', // Panevėžio Apskritis
        'SA', // Šiaulių Apskritis
        'TA', // Tauragés Apskritis
        'TE', // Telšių Apskritis
        'UT', // Utenos Apskritis
        'VL', // Vilniaus Apskritis
    ];

    public $compareIdentical = true;
}
