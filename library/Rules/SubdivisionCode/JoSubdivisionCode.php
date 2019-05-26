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
 * Validator for Jordan subdivision code.
 *
 * ISO 3166-1 alpha-2: JO
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class JoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AJ', // ‘Ajlūn
        'AM', // ‘Ammān (Al ‘Aşimah)
        'AQ', // Al ‘Aqabah
        'AT', // Aţ Ţafīlah
        'AZ', // Az Zarqā'
        'BA', // Al Balqā'
        'IR', // Irbid
        'JA', // Jarash
        'KA', // Al Karak
        'MA', // Al Mafraq
        'MD', // Mādabā
        'MN', // Ma‘ān
    ];

    public $compareIdentical = true;
}
