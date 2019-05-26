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
 * Validator for Saint Helena subdivision code.
 *
 * ISO 3166-1 alpha-2: SH
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ShSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AC', // Ascension
        'HL', // Saint Helena
        'TA', // Tristan da Cunha
    ];

    public $compareIdentical = true;
}
