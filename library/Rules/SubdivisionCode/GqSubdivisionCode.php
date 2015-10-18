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
 * Validator for Equatorial Guinea subdivision code.
 *
 * ISO 3166-1 alpha-2: GQ
 *
 * @link http://www.geonames.org/GQ/administrative-division-equatorial-guinea.html
 */
class GqSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'C', // Región Continental
        'I', // Región Insular
        'AN', // Provincia Annobon
        'BN', // Provincia Bioko Norte
        'BS', // Provincia Bioko Sur
        'CS', // Provincia Centro Sur
        'KN', // Provincia Kie-Ntem
        'LI', // Provincia Litoral
        'WN', // Provincia Wele-Nzas
    ];

    public $compareIdentical = true;
}
