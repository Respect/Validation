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
 * Validator for Haiti subdivision code.
 *
 * ISO 3166-1 alpha-2: HT
 *
 * @link http://www.geonames.org/HT/administrative-division-haiti.html
 */
class HtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AR', // Artibonite
        'CE', // Centre
        'GA', // Grand'Anse
        'ND', // Nord
        'NE', // Nord-Est
        'NO', // Nord-Ouest
        'OU', // Ouest
        'SD', // Sud
        'SE', // Sud-Est
    ];

    public $compareIdentical = true;
}
