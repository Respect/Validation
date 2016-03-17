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
 * Validator for Iceland subdivision code.
 *
 * ISO 3166-1 alpha-2: IS
 *
 * @link http://www.geonames.org/IS/administrative-division-iceland.html
 */
class IsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Höfuðborgarsvæði
        '2', // Suðurnes
        '3', // Vesturland
        '4', // Vestfirðir
        '5', // Norðurland Vestra
        '6', // Norðurland Eystra
        '7', // Austurland
        '8', // Suðurland
    ];

    public $compareIdentical = true;
}
