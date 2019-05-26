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
 * Validator for Vanuatu subdivision code.
 *
 * ISO 3166-1 alpha-2: VU
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class VuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'MAP', // Malampa
        'PAM', // Pénama
        'SAM', // Sanma
        'SEE', // Shéfa
        'TAE', // Taféa
        'TOB', // Torba
    ];

    public $compareIdentical = true;
}
