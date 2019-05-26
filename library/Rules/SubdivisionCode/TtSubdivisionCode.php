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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class TtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ARI', // Arima
        'CHA', // Chaguanas
        'CTT', // Couva-Tabaquite-Talparo
        'DMN', // Diego Martin
        'ETO', // Eastern Tobago
        'PED', // Penal-Debe
        'POS', // Port of Spain
        'PRT', // Princes Town
        'PTF', // Point Fortin
        'RCM', // Rio Claro-Mayaro
        'SFO', // San Fernando
        'SGE', // Sangre Grande
        'SIP', // Siparia
        'SJL', // San Juan-Laventille
        'TUP', // Tunapuna-Piarco
        'WTO', // Western Tobago
    ];

    public $compareIdentical = true;
}
