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
 * Validator for Ireland subdivision code.
 *
 * ISO 3166-1 alpha-2: IE
 *
 * @link http://www.geonames.org/IE/administrative-division-ireland.html
 */
class IeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'C', // Connaught
        'L', // Leinster
        'M', // Munster
        'U', // Ulster
        'C', // Cork
        'CE', // Clare
        'CN', // Cavan
        'CW', // Carlow
        'D', // Dublin
        'DL', // Donegal
        'G', // Galway
        'KE', // Kildare
        'KK', // Kilkenny
        'KY', // Kerry
        'LD', // Longford
        'LH', // Louth
        'LK', // Limerick
        'LM', // Leitrim
        'LS', // Laois
        'MH', // Meath
        'MN', // Monaghan
        'MO', // Mayo
        'OY', // Offaly
        'RN', // Roscommon
        'SO', // Sligo
        'TA', // Tipperary
        'WD', // Waterford
        'WH', // Westmeath
        'WW', // Wicklow
        'WX', // Wexford
    ];

    public $compareIdentical = true;
}
