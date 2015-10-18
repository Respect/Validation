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
 * Validator for Luxembourg subdivision code.
 *
 * ISO 3166-1 alpha-2: LU
 *
 * @link http://www.geonames.org/LU/administrative-division-luxembourg.html
 */
class LuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'D', // Diekirch
        'G', // Grevenmacher
        'L', // Luxembourg
    ];

    public $compareIdentical = true;
}
