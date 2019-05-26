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
 * Validator for Laos subdivision code.
 *
 * ISO 3166-1 alpha-2: LA
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class LaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AT', // Attapu
        'BK', // Bokèo
        'BL', // Bolikhamxai
        'CH', // Champasak
        'HO', // Houaphan
        'KH', // Khammouan
        'LM', // Louang Namtha
        'LP', // Louangphabang
        'OU', // Oudômxai
        'PH', // Phôngsali
        'SL', // Salavan
        'SV', // Savannakhét
        'VI', // Vientiane
        'VT', // Vientiane
        'XA', // Xaignabouli
        'XE', // Xékong
        'XI', // Xiangkhouang
        'XS', // Xaisômboun
    ];

    public $compareIdentical = true;
}
