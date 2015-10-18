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
 * Validator for Dominica subdivision code.
 *
 * ISO 3166-1 alpha-2: DM
 *
 * @link http://www.geonames.org/DM/administrative-division-dominica.html
 */
class DmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '02', // Saint Andrew Parish
        '03', // Saint David Parish
        '04', // Saint George Parish
        '05', // Saint John Parish
        '06', // Saint Joseph Parish
        '07', // Saint Luke Parish
        '08', // Saint Mark Parish
        '09', // Saint Patrick Parish
        '10', // Saint Paul Parish
        '11', // Saint Peter Parish
    ];

    public $compareIdentical = true;
}
