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
 * Validator for Cuba subdivision code.
 *
 * ISO 3166-1 alpha-2: CU
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Pinar del Rio
        '02', // La Habana
        '03', // Ciudad de La Habana
        '04', // Matanzas
        '05', // Villa Clara
        '06', // Cienfuegos
        '07', // Sancti Spíritus
        '08', // Ciego de Ávila
        '09', // Camagüey
        '10', // Las Tunas
        '11', // Holguín
        '12', // Granma
        '13', // Santiago de Cuba
        '14', // Guantánamo
        '99', // Isla de la Juventud
    ];

    public $compareIdentical = true;
}
