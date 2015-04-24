<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Belarus country subdivision.
 *
 * ISO 3166-1 alpha-2: BY
 *
 * @link http://www.geonames.org/BY/administrative-division-belarus.html
 */
class ByCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BR', // Brest voblast
        'HM', // Horad Minsk
        'HO', // Homyel voblast
        'HR', // Hrodna voblast
        'MA', // Mahilyow voblast
        'MI', // Minsk voblast
        'VI', // Vitsebsk voblast
    );

    public $compareIdentical = true;
}
