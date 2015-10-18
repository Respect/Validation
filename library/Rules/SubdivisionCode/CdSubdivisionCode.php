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
 * @link http://www.geonames.org/CD/administrative-division-democratic-republic-of-the-congo.html
 */
class CdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BC', // Bas-Congo
        'BN', // Bandundu
        'EQ', // Equateur
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
