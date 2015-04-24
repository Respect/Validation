<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Somalia country subdivision.
 *
 * ISO 3166-1 alpha-2: SO
 *
 * @link http://www.geonames.org/SO/administrative-division-somalia.html
 */
class SoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AW', // Awdal
        'BK', // Bakool
        'BN', // Banaadir
        'BR', // Bari
        'BY', // Bay
        'GA', // Galguduud
        'GE', // Gedo
        'HI', // Hiiraan
        'JD', // Jubbada Dhexe
        'JH', // Jubbada Hoose
        'MU', // Mudug
        'NU', // Nugaal
        'SA', // Sanaag
        'SD', // Shabeellaha Dhexe
        'SH', // Shabeellaha Hoose
        'SO', // Sool
        'TO', // Togdheer
        'WO', // Woqooyi Galbeed
    );

    public $compareIdentical = true;
}
