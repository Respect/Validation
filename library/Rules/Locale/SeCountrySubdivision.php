<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Sweden country subdivision.
 *
 * ISO 3166-1 alpha-2: SE
 *
 * @link http://www.geonames.org/SE/administrative-division-sweden.html
 */
class SeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}
