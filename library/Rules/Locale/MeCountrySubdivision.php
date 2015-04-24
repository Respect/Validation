<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Montenegro country subdivision.
 *
 * ISO 3166-1 alpha-2: ME
 *
 * @link http://www.geonames.org/ME/administrative-division-montenegro.html
 */
class MeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Opština Andrijevica
        '02', // Opština Bar
        '03', // Opština Berane
        '04', // Opština Bijelo Polje
        '05', // Opština Budva
        '06', // Opština Cetinje
        '07', // Opština Danilovgrad
        '08', // Opština Herceg-Novi
        '09', // Opština Kolašin
        '10', // Opština Kotor
        '11', // Opština Mojkovac
        '12', // Opština Nikšić
        '13', // Opština Plav
        '14', // Opština Pljevlja
        '15', // Opština Plužine
        '16', // Opština Podgorica
        '17', // Opština Rožaje
        '18', // Opština Šavnik
        '19', // Opština Tivat
        '20', // Opština Ulcinj
        '21', // Opština Žabljak
    );

    public $compareIdentical = true;
}
