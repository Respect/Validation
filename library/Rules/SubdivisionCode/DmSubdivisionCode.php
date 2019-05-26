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
 * Validator for Dominica subdivision code.
 *
 * ISO 3166-1 alpha-2: DM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class DmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Saint Peter
        '02', // Saint Andrew
        '03', // Saint David
        '04', // Saint George
        '05', // Saint John
        '06', // Saint Joseph
        '07', // Saint Luke
        '08', // Saint Mark
        '09', // Saint Patrick
        '10', // Saint Paul
    ];

    public $compareIdentical = true;
}
