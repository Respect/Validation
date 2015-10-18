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
 * Validator for Germany subdivision code.
 *
 * ISO 3166-1 alpha-2: DE
 *
 * @link http://www.geonames.org/DE/administrative-division-germany.html
 */
class DeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BB', // Brandenburg
        'BE', // Berlin
        'BW', // Baden-Württemberg
        'BY', // Bayern
        'HB', // Bremen
        'HE', // Hessen
        'HH', // Hamburg
        'MV', // Mecklenburg-Vorpommern
        'NI', // Niedersachsen
        'NW', // Nordrhein-Westfalen
        'RP', // Rheinland-Pfalz
        'SH', // Schleswig-Holstein
        'SL', // Saarland
        'SN', // Sachsen
        'ST', // Sachsen-Anhalt
        'TH', // Thüringen
    ];

    public $compareIdentical = true;
}
