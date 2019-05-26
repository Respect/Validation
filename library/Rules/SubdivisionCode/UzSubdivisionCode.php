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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
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
        'QR', // Qoraqalpog'iston Respublikasi
        'SA', // Samarqand
        'SI', // Sirdaryo
        'SU', // Surxondaryo
        'TK', // Toshkent
        'TO', // Toshkent
        'XO', // Xorazm
    ];

    public $compareIdentical = true;
}
