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
 * Validator for Mali subdivision code.
 *
 * ISO 3166-1 alpha-2: ML
 *
 * @link http://www.geonames.org/ML/administrative-division-mali.html
 */
class MlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Kayes
        '2', // Koulikoro
        '3', // Sikasso
        '4', // Segou
        '5', // Mopti
        '6', // Tombouctou
        '7', // Gao
        '8', // Kidal
        'BKO', // Bamako Capital District
    ];

    public $compareIdentical = true;
}
