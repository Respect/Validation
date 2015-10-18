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
 * Validator for Samoa subdivision code.
 *
 * ISO 3166-1 alpha-2: WS
 *
 * @link http://www.geonames.org/WS/administrative-division-samoa.html
 */
class WsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AA', // A'ana
        'AL', // Aiga-i-le-Tai
        'AT', // Atua
        'FA', // Fa'asaleleaga
        'GE', // Gaga'emauga
        'GI', // Gagaifomauga
        'PA', // Palauli
        'SA', // Satupa'itea
        'TU', // Tuamasaga
        'VF', // Va'a-o-Fonoti
        'VS', // Vaisigano
    ];

    public $compareIdentical = true;
}
