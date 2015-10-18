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
 * Validator for Bosnia and Herzegovina subdivision code.
 *
 * ISO 3166-1 alpha-2: BA
 *
 * @link http://www.geonames.org/BA/administrative-division-bosnia-and-herzegovina.html
 */
class BaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BIH', // Federacija Bosna i Hercegovina
        'BRC', // Brcko District
        'SRP', // Republika Srpska
        '01', // Unsko-sanski kanton
        '02', // Posavski kanton
        '03', // Tuzlanski kanton
        '04', // Zeničko-dobojski kanton
        '05', // Bosansko-podrinjski kanton
        '06', // Srednjobosanski kantonn
        '07', // Hercegovačko-neretvanski kanton
        '08', // Zapadnohercegovački kanton
        '09', // Kanton Sarajevo
        '10', // Kanton br. 10 (Livanjski kanton)
    ];

    public $compareIdentical = true;
}
