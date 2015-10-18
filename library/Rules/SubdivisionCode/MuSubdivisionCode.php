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
 * Validator for Mauritius subdivision code.
 *
 * ISO 3166-1 alpha-2: MU
 *
 * @link http://www.geonames.org/MU/administrative-division-mauritius.html
 */
class MuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AG', // Agalega Islands
        'BL', // Black River
        'BR', // Beau Bassin-Rose Hill
        'CC', // Cargados Carajos Shoals (Saint Brandon Islands)
        'CU', // Curepipe
        'FL', // Flacq
        'GP', // Grand Port
        'MO', // Moka
        'PA', // Pamplemousses
        'PL', // Port Louis
        'PU', // Port Louis
        'PW', // Plaines Wilhems
        'QB', // Quatre Bornes
        'RO', // Rodrigues
        'RR', // Riviere du Rempart
        'SA', // Savanne
        'VP', // Vacoas-Phoenix
    ];

    public $compareIdentical = true;
}
