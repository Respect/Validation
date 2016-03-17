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
 * Validator for Poland subdivision code.
 *
 * ISO 3166-1 alpha-2: PL
 *
 * @link http://www.geonames.org/PL/administrative-division-poland.html
 */
class PlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DS', // Dolnoslaskie
        'KP', // Kujawsko-Pomorskie
        'LB', // Lubuskie
        'LD', // Lodzkie
        'LU', // Lubelskie
        'MA', // Malopolskie
        'MZ', // Mazowieckie
        'OP', // Opolskie
        'PD', // Podlaskie
        'PK', // Podkarpackie
        'PM', // Pomorskie
        'SK', // Swietokrzyskie
        'SL', // Slaskie
        'WN', // Warminsko-Mazurskie
        'WP', // Wielkopolskie
        'ZP', // Zachodniopomorskie
    ];

    public $compareIdentical = true;
}
