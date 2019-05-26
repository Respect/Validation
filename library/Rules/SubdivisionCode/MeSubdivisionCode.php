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
 * Validator for Montenegro subdivision code.
 *
 * ISO 3166-1 alpha-2: ME
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Andrijevica
        '02', // Bar
        '03', // Berane
        '04', // Bijelo Polje
        '05', // Budva
        '06', // Cetinje
        '07', // Danilovgrad
        '08', // Herceg-Novi
        '09', // Kolašin
        '10', // Kotor
        '11', // Mojkovac
        '12', // Nikšić
        '13', // Plav
        '14', // Pljevlja
        '15', // Plužine
        '16', // Podgorica
        '17', // Rožaje
        '18', // Šavnik
        '19', // Tivat
        '20', // Ulcinj
        '21', // Žabljak
    ];

    public $compareIdentical = true;
}
