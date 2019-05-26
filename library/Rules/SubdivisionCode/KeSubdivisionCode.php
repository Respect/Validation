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
 * Validator for Kenya subdivision code.
 *
 * ISO 3166-1 alpha-2: KE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '110', // Nairobi Municipality
        '200', // Central
        '300', // Coast
        '400', // Eastern
        '500', // North-Eastern Kaskazini Mashariki
        '700', // Rift Valley
        '800', // Western Magharibi
    ];

    public $compareIdentical = true;
}
