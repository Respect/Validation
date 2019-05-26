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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Estuaire
        '2', // Haut-Ogooué
        '3', // Moyen-Ogooué
        '4', // Ngounié
        '5', // Nyanga
        '6', // Ogooué-Ivindo
        '7', // Ogooué-Lolo
        '8', // Ogooué-Maritime
        '9', // Woleu-Ntem
    ];

    public $compareIdentical = true;
}
