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
 * Validator for Equatorial Guinea subdivision code.
 *
 * ISO 3166-1 alpha-2: GQ
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GqSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Annobón
        'BN', // Bioko Norte
        'BS', // Bioko Sur
        'C', // Región Continental
        'CS', // Centro Sur
        'I', // Región Insular
        'KN', // Kié-Ntem
        'LI', // Litoral
        'WN', // Wele-Nzas
    ];

    public $compareIdentical = true;
}
