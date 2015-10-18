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
 * Validator for Lithuania subdivision code.
 *
 * ISO 3166-1 alpha-2: LT
 *
 * @link http://www.geonames.org/LT/administrative-division-lithuania.html
 */
class LtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AL', // Alytus
        'KL', // Klaipeda
        'KU', // Kaunas
        'MR', // Marijampole
        'PN', // Panevezys
        'SA', // Siauliai
        'TA', // Taurage
        'TE', // Telsiai
        'UT', // Utena
        'VL', // Vilnius
    ];

    public $compareIdentical = true;
}
