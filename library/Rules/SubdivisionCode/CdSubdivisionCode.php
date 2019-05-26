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
 * Validator for Democratic Republic of the Congo subdivision code.
 *
 * ISO 3166-1 alpha-2: CD
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BC', // Bas-Congo
        'BN', // Bandundu
        'EQ', // Équateur
        'KA', // Katanga
        'KE', // Kasai-Oriental
        'KN', // Kinshasa
        'KW', // Kasai-Occidental
        'MA', // Maniema
        'NK', // Nord-Kivu
        'OR', // Orientale
        'SK', // Sud-Kivu
    ];

    public $compareIdentical = true;
}
