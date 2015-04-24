<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Panama country subdivision.
 *
 * ISO 3166-1 alpha-2: PA
 *
 * @link http://www.geonames.org/PA/administrative-division-panama.html
 */
class PaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Bocas del Toro
        '2', // Cocle
        '3', // Colon
        '4', // Chiriqui
        '5', // Darien
        '6', // Herrera
        '7', // Los Santos
        '8', // Panama
        '9', // Veraguas
        'EM', // Comarca Emberá-Wounaan
        'KY', // Comarca de Kuna Yala
        'NB', // Ngöbe-Buglé
    );

    public $compareIdentical = true;
}
