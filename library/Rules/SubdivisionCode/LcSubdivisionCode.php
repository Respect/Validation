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
        'AR', // Anse-la-Raye
        'CA', // Castries
        'CH', // Choiseul
        'DA', // Dauphin
        'DE', // Dennery
        'GI', // Gros-Islet
        'LA', // Laborie
        'MI', // Micoud
        'PR', // Praslin
        'SO', // Soufriere
        'VF', // Vieux-Fort
    ];

    public $compareIdentical = true;
}
