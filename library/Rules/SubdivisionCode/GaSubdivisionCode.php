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
 * Validator for Gabon subdivision code.
 *
 * ISO 3166-1 alpha-2: GA
 *
 * @link http://www.geonames.org/GA/administrative-division-gabon.html
 */
class GaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Estuaire
        '2', // Haut-Ogooue
        '3', // Moyen-Ogooue
        '4', // Ngounie
        '5', // Nyanga
        '6', // Ogooue-Ivindo
        '7', // Ogooue-Lolo
        '8', // Ogooue-Maritime
        '9', // Woleu-Ntem
    ];

    public $compareIdentical = true;
}
