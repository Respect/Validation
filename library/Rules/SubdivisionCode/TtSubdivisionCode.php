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
 * Validator for Trinidad and Tobago subdivision code.
 *
 * ISO 3166-1 alpha-2: TT
 *
 * @link http://www.geonames.org/TT/administrative-division-trinidad-and-tobago.html
 */
class TtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ARI', // Arima
        'CHA', // Chaguanas
        'CTT', // Couva/Tabaquite/Talparo
        'DMN', // Diego Martin
        'MRC', // Mayaro/Rio Claro
        'PED', // Penal/Debe
        'POS', // Port of Spain
        'PRT', // Princes Town
        'PTF', // Point Fortin
        'SFO', // San Fernando
        'SGE', // Sangre Grande
        'SIP', // Siparia
        'SJL', // San Juan/Laventille
        'TOB', // Tobago
        'TUP', // Tunapuna/Piarco
    ];

    public $compareIdentical = true;
}
