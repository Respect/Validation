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
 * Validator for South Africa subdivision code.
 *
 * ISO 3166-1 alpha-2: ZA
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ZaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'EC', // Eastern Cape
        'FS', // Free State
        'GT', // Gauteng
        'LP', // Limpopo
        'MP', // Mpumalanga
        'NC', // Northern Cape
        'NL', // Kwazulu-Natal
        'NW', // North-West (South Africa)
        'WC', // Western Cape
    ];

    public $compareIdentical = true;
}
