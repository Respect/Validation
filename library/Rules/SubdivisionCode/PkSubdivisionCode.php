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
 * Validator for Pakistan subdivision code.
 *
 * ISO 3166-1 alpha-2: PK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Balochistan
        'GB', // Gilgit-Baltistan
        'IS', // Islamabad
        'JK', // Azad Kashmir
        'KP', // Khyber Pakhtunkhwa
        'PB', // Punjab
        'SD', // Sindh
        'TA', // Federally Administered Tribal Areas
    ];

    public $compareIdentical = true;
}
