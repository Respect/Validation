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
 * Validator for Sweden subdivision code.
 *
 * ISO 3166-1 alpha-2: SE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Stockholms län
        'AC', // Västerbottens län
        'BD', // Norrbottens län
        'C', // Uppsala län
        'D', // Södermanlands län
        'E', // Östergötlands län
        'F', // Jönköpings län
        'G', // Kronobergs län
        'H', // Kalmar län
        'I', // Gotlands län
        'K', // Blekinge län
        'M', // Skåne län
        'N', // Hallands län
        'O', // Västra Götalands län
        'S', // Värmlands län
        'T', // Örebro län
        'U', // Västmanlands län
        'W', // Dalarnas län
        'X', // Gävleborgs län
        'Y', // Västernorrlands län
        'Z', // Jämtlands län
    ];

    public $compareIdentical = true;
}
