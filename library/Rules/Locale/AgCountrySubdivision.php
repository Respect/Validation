<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Antigua and Barbuda country subdivision.
 *
 * ISO 3166-1 alpha-2: AG
 *
 * @link http://www.geonames.org/AG/administrative-division-antigua-and-barbuda.html
 */
class AgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '03', // Saint George
        '04', // Saint John
        '05', // Saint Mary
        '06', // Saint Paul
        '07', // Saint Peter
        '08', // Saint Philip
        '10', // Barbuda
        '11', // Redonda
    );

    public $compareIdentical = true;
}
