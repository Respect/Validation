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
 * Validator for Cameroon subdivision code.
 *
 * ISO 3166-1 alpha-2: CM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AD', // Adamaoua
        'CE', // Centre
        'EN', // Far North
        'ES', // East
        'LT', // Littoral
        'NO', // North
        'NW', // North-West (Cameroon)
        'OU', // West
        'SU', // South
        'SW', // South-West
    ];

    public $compareIdentical = true;
}
