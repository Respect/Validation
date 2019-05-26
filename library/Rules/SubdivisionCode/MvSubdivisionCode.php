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
 * Validator for Maldives subdivision code.
 *
 * ISO 3166-1 alpha-2: MV
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '00', // Alifu Dhaalu
        '01', // Seenu
        '02', // Alifu Alifu
        '03', // Lhaviyani
        '04', // Vaavu
        '05', // Laamu
        '07', // Haa Alifu
        '08', // Thaa
        '12', // Meemu
        '13', // Raa
        '14', // Faafu
        '17', // Dhaalu
        '20', // Baa
        '23', // Haa Dhaalu
        '24', // Shaviyani
        '25', // Noonu
        '26', // Kaafu
        '27', // Gaafu Alifu
        '28', // Gaafu Dhaalu
        '29', // Gnaviyani
        'CE', // Central
        'MLE', // Male
        'NC', // North Central
        'NO', // North
        'SC', // South Central
        'SU', // South
        'UN', // Upper North
        'US', // Upper South
    ];

    public $compareIdentical = true;
}
