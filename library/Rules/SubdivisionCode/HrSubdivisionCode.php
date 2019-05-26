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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class HrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Zagrebačka županija
        '02', // Krapinsko-zagorska županija
        '03', // Sisačko-moslavačka županija
        '04', // Karlovačka županija
        '05', // Varaždinska županija
        '06', // Koprivničko-križevačka županija
        '07', // Bjelovarsko-bilogorska županija
        '08', // Primorsko-goranska županija
        '09', // Ličko-senjska županija
        '10', // Virovitičko-podravska županija
        '11', // Požeško-slavonska županija
        '12', // Brodsko-posavska županija
        '13', // Zadarska županija
        '14', // Osječko-baranjska županija
        '15', // Šibensko-kninska županija
        '16', // Vukovarsko-srijemska županija
        '17', // Splitsko-dalmatinska županija
        '18', // Istarska županija
        '19', // Dubrovačko-neretvanska županija
        '20', // Međimurska županija
        '21', // Grad Zagreb
    ];

    public $compareIdentical = true;
}
