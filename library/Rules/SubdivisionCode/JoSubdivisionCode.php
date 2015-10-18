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
 * @link http://www.geonames.org/JO/administrative-division-jordan.html
 */
class JoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AJ', // Ajlun
        'AM', // 'Amman
        'AQ', // Al 'Aqabah
        'AT', // At Tafilah
        'AZ', // Az Zarqa'
        'BA', // Al Balqa'
        'IR', // Irbid
        'JA', // Jarash
        'KA', // Al Karak
        'MA', // Al Mafraq
        'MD', // Madaba
        'MN', // Ma'an
    ];

    public $compareIdentical = true;
}
