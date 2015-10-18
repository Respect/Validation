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
 * Validator for Lebanon subdivision code.
 *
 * ISO 3166-1 alpha-2: LB
 *
 * @link http://www.geonames.org/LB/administrative-division-lebanon.html
 */
class LbSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AK', // Aakkâr
        'AS', // Liban-Nord
        'BA', // Beyrouth
        'BH', // Baalbek-Hermel
        'BI', // Béqaa
        'JA', // Liban-Sud
        'JL', // Mont-Liban
        'NA', // Nabatîyé
    ];

    public $compareIdentical = true;
}
