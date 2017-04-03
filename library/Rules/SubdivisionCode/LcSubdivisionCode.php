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
 * Validator for Saint Lucia subdivision code.
 *
 * ISO 3166-1 alpha-2: LC
 *
 * @link http://www.geonames.org/LC/administrative-division-saint-lucia.html
 */
class LcSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Anse-la-Raye
        '02', // Castries
        '03', // Choiseul
        '05', // Dennery
        '06', // Gros-Islet
        '07', // Laborie
        '08', // Micoud
        '10', // Soufriere
        '11', // Vieux-Fort
        '12', // Canaries
    ];

    public $compareIdentical = true;
}
