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
 * Validator for Uzbekistan subdivision code.
 *
 * ISO 3166-1 alpha-2: UZ
 *
 * @link http://www.geonames.org/UZ/administrative-division-uzbekistan.html
 */
class UzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Andijon
        'BU', // Buxoro
        'FA', // Farg'ona
        'JI', // Jizzax
        'NG', // Namangan
        'NW', // Navoiy
        'QA', // Qashqadaryo
        'QR', // Qoraqalpog'iston Republikasi
        'SA', // Samarqand
        'SI', // Sirdaryo
        'SU', // Surxondaryo
        'TK', // Toshkent city
        'TO', // Toshkent region
        'XO', // Xorazm
    ];

    public $compareIdentical = true;
}
