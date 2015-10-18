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
 * @link http://www.geonames.org/SE/administrative-division-sweden.html
 */
class SeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Stockholms
        'AC', // Vasterbottens
        'BD', // Norrbottens
        'C', // Uppsala
        'D', // Sodermanlands
        'E', // Ostergotlands
        'F', // Jonkopings
        'G', // Kronobergs
        'H', // Kalmar
        'I', // Gotlands
        'K', // Blekinge
        'M', // Skåne
        'N', // Hallands
        'O', // Västra Götaland
        'S', // Varmlands
        'T', // Orebro
        'U', // Vastmanlands
        'W', // Dalarna
        'X', // Gavleborgs
        'Y', // Vasternorrlands
        'Z', // Jamtlands
    ];

    public $compareIdentical = true;
}
