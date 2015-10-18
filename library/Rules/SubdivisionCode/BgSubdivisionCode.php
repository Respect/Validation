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
 * Validator for Bulgaria subdivision code.
 *
 * ISO 3166-1 alpha-2: BG
 *
 * @link http://www.geonames.org/BG/administrative-division-bulgaria.html
 */
class BgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Blagoevgrad
        '02', // Burgas
        '03', // Varna
        '04', // Veliko Turnovo
        '05', // Vidin
        '06', // Vratsa
        '07', // Gabrovo
        '08', // Dobrich
        '09', // Kurdzhali
        '10', // Kyustendil
        '11', // Lovech
        '12', // Montana
        '13', // Pazardzhik
        '14', // Pernik
        '15', // Pleven
        '16', // Plovdiv
        '17', // Razgrad
        '18', // Ruse
        '19', // Silistra
        '20', // Sliven
        '21', // Smolyan
        '22', // Sofia Region
        '23', // Sofia
        '24', // Stara Zagora
        '25', // Turgovishte
        '26', // Khaskovo
        '27', // Shumen
        '28', // Yambol
    ];

    public $compareIdentical = true;
}
