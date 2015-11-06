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
 * Validator for El Salvador subdivision code.
 *
 * ISO 3166-1 alpha-2: SV
 *
 * @link http://www.geonames.org/SV/administrative-division-el-salvador.html
 */
class SvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AH', // Ahuachapan
        'CA', // Cabanas
        'CH', // Chalatenango
        'CU', // Cuscatlan
        'LI', // La Libertad
        'MO', // Morazan
        'PA', // La Paz
        'SA', // Santa Ana
        'SM', // San Miguel
        'SO', // Sonsonate
        'SS', // San Salvador
        'SV', // San Vicente
        'UN', // La Union
        'US', // Usulutan
    ];

    public $compareIdentical = true;
}
