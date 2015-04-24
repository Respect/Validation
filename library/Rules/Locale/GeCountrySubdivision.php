<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Georgia country subdivision.
 *
 * ISO 3166-1 alpha-2: GE
 *
 * @link http://www.geonames.org/GE/administrative-division-georgia.html
 */
class GeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AB', // Abkhazia
        'AJ', // Ajaria
        'GU', // Guria
        'IM', // Imereti
        'KA', // Kakheti
        'KK', // Kvemo Kartli
        'MM', // Mtskheta-Mtianeti
        'RL', // Racha Lechkhumi and Kvemo Svaneti
        'SJ', // Samtskhe-Javakheti
        'SK', // Shida Kartli
        'SZ', // Samegrelo-Zemo Svaneti
        'TB', // Tbilisi
    );

    public $compareIdentical = true;
}
