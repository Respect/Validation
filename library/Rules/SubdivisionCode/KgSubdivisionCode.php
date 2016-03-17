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
 * Validator for Kyrgyzstan subdivision code.
 *
 * ISO 3166-1 alpha-2: KG
 *
 * @link http://www.geonames.org/KG/administrative-division-kyrgyzstan.html
 */
class KgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Batken
        'C', // Chu
        'GB', // Bishkek
        'GO', // Osh City
        'J', // Jalal-Abad
        'N', // Naryn
        'O', // Osh
        'T', // Talas
        'Y', // Ysyk-Kol
    ];

    public $compareIdentical = true;
}
