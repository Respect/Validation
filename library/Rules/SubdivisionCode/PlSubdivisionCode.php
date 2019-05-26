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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DS', // Dolnośląskie
        'KP', // Kujawsko-pomorskie
        'LB', // Lubuskie
        'LD', // Łódzkie
        'LU', // Lubelskie
        'MA', // Małopolskie
        'MZ', // Mazowieckie
        'OP', // Opolskie
        'PD', // Podlaskie
        'PK', // Podkarpackie
        'PM', // Pomorskie
        'SK', // Świętokrzyskie
        'SL', // Śląskie
        'WN', // Warmińsko-mazurskie
        'WP', // Wielkopolskie
        'ZP', // Zachodniopomorskie
    ];

    public $compareIdentical = true;
}
