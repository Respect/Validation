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
 * Validator for Lesotho subdivision code.
 *
 * ISO 3166-1 alpha-2: LS
 *
 * @link http://www.geonames.org/LS/administrative-division-lesotho.html
 */
class LsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Maseru
        'B', // Butha-Buthe
        'C', // Leribe
        'D', // Berea
        'E', // Mafeteng
        'F', // Mohale's Hoek
        'G', // Quthing
        'H', // Qacha's Nek
        'J', // Mokhotlong
        'K', // Thaba-Tseka
    ];

    public $compareIdentical = true;
}
