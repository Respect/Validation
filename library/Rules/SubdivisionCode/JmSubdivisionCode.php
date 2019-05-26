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
 * Validator for Jamaica subdivision code.
 *
 * ISO 3166-1 alpha-2: JM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class JmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Kingston
        '02', // Saint Andrew
        '03', // Saint Thomas
        '04', // Portland
        '05', // Saint Mary
        '06', // Saint Ann
        '07', // Trelawny
        '08', // Saint James
        '09', // Hanover
        '10', // Westmoreland
        '11', // Saint Elizabeth
        '12', // Manchester
        '13', // Clarendon
        '14', // Saint Catherine
    ];

    public $compareIdentical = true;
}
