<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bosnia and Herzegovina country subdivision.
 *
 * ISO 3166-1 alpha-2: BA
 *
 * @link http://www.geonames.org/BA/administrative-division-bosnia-and-herzegovina.html
 */
class BaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BIH', // Federacija Bosna i Hercegovina
        'BRC', // Brcko District
        'SRP', // Republika Srpska
        '01', // Unsko-sanski kanton
        '02', // Posavski kanton
        '03', // Tuzlanski kanton
        '04', // Zeničko-dobojski kanton
        '05', // Bosansko-podrinjski kanton
        '06', // Srednjobosanski kantonn
        '07', // Hercegovačko-neretvanski kanton
        '08', // Zapadnohercegovački kanton
        '09', // Kanton Sarajevo
        '10', // Kanton br. 10 (Livanjski kanton)
    );

    public $compareIdentical = true;
}
