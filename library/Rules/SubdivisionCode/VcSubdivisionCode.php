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
 * Validator for Saint Vincent and the Grenadines subdivision code.
 *
 * ISO 3166-1 alpha-2: VC
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class VcSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Charlotte
        '02', // Saint Andrew
        '03', // Saint David
        '04', // Saint George
        '05', // Saint Patrick
        '06', // Grenadines
    ];

    public $compareIdentical = true;
}
