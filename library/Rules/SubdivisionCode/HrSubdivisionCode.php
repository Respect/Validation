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
 * Validator for Croatia subdivision code.
 *
 * ISO 3166-1 alpha-2: HR
 *
 * @link http://www.geonames.org/HR/administrative-division-croatia.html
 */
class HrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Zagreb county
        '02', // Krapina-Zagorje county
        '03', // Sisak-Moslavina county
        '04', // Karlovac county
        '05', // Varazdin county
        '06', // Koprivnica-Krizevci county
        '07', // Bjelovar-Bilogora county
        '08', // Primorje-Gorski Kotar county
        '09', // Lika-Senj county
        '10', // Virovitica-Podravina county
        '11', // Pozega-Slavonia county
        '12', // Brod-Posavina county
        '13', // Zadar county
        '14', // Osijek-Baranja county
        '15', // Sibenik-Knin county
        '16', // Vukovar-Srijem county
        '17', // Split-Dalmatia county
        '18', // Istria county
        '19', // Dubrovnik-Neretva county
        '20', // Medjimurje county
        '21', // Zagreb (city)
    ];

    public $compareIdentical = true;
}
