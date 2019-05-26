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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AH', // Ahuachapán
        'CA', // Cabañas
        'CH', // Chalatenango
        'CU', // Cuscatlán
        'LI', // La Libertad
        'MO', // Morazán
        'PA', // La Paz
        'SA', // Santa Ana
        'SM', // San Miguel
        'SO', // Sonsonate
        'SS', // San Salvador
        'SV', // San Vicente
        'UN', // La Unión
        'US', // Usulután
    ];

    public $compareIdentical = true;
}
