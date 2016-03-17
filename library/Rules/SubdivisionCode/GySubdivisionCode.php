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
 * Validator for Guyana subdivision code.
 *
 * ISO 3166-1 alpha-2: GY
 *
 * @link http://www.geonames.org/GY/administrative-division-guyana.html
 */
class GySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Barima-Waini
        'CU', // Cuyuni-Mazaruni
        'DE', // Demerara-Mahaica
        'EB', // East Berbice-Corentyne
        'ES', // Essequibo Islands-West Demerara
        'MA', // Mahaica-Berbice
        'PM', // Pomeroon-Supenaam
        'PT', // Potaro-Siparuni
        'UD', // Upper Demerara-Berbice
        'UT', // Upper Takutu-Upper Essequibo
    ];

    public $compareIdentical = true;
}
