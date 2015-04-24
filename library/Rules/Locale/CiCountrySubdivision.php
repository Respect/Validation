<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Ivory Coast country subdivision.
 *
 * ISO 3166-1 alpha-2: CI
 *
 * @link http://www.geonames.org/CI/administrative-division-ivory-coast.html
 */
class CiCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Lagunes (Région des)
        '02', // Haut-Sassandra (Région du)
        '03', // Savanes (Région des)
        '04', // Vallée du Bandama (Région de la)
        '05', // Moyen-Comoé (Région du)
        '06', // 18 Montagnes (Région des)
        '07', // Lacs (Région des)
        '08', // Zanzan (Région du)
        '09', // Bas-Sassandra (Région du)
        '10', // Denguélé (Région du)
        '11', // Nzi-Comoé (Région)
        '12', // Marahoué (Région de la)
        '13', // Sud-Comoé (Région du)
        '14', // Worodougou (Région du)
        '15', // Sud-Bandama (Région du)
        '16', // Agnébi (Région de l')
        '17', // Bafing (Région du)
        '18', // Fromager (Région du)
        '19', // Moyen-Cavally (Région du)
    );

    public $compareIdentical = true;
}
