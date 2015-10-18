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
 * Validator for Ukraine subdivision code.
 *
 * ISO 3166-1 alpha-2: UA
 *
 * @link http://www.geonames.org/UA/administrative-division-ukraine.html
 */
class UaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '05', // Vinnytsya
        '07', // Volyn'
        '09', // Luhans'k
        '12', // Dnipropetrovs'k
        '14', // Donets'k
        '18', // Zhytomyr
        '21', // Zakarpattya
        '23', // Zaporizhzhya
        '26', // Ivano-Frankivs'k
        '30', // Kyyiv
        '32', // Kiev
        '35', // Kirovohrad
        '40', // Sevastopol
        '43', // Crimea
        '46', // L'viv
        '48', // Mykolayiv
        '51', // Odesa
        '53', // Poltava
        '56', // Rivne
        '59', // Sumy
        '61', // Ternopil'
        '63', // Kharkiv
        '65', // Kherson
        '68', // Khmel'nyts'kyy
        '71', // Cherkasy
        '74', // Chernihiv
        '77', // Chernivtsi
    ];

    public $compareIdentical = true;
}
