<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Chad country subdivision.
 *
 * ISO 3166-1 alpha-2: TD
 *
 * @link http://www.geonames.org/TD/administrative-division-chad.html
 */
class TdCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BA', // Batha
        'BG', // Barh el Ghazel
        'BO', // Borkou
        'CB', // Chari-Baguirmi
        'EN', // Ennedi Est
        'EN', // Ennedi Quest
        'GR', // Guéra
        'HL', // Hadjer-Lamis
        'KA', // Kanem
        'LC', // Lac
        'LO', // Logone Occidental
        'LR', // Logone Oriental
        'MA', // Mandoul
        'MC', // Moyen-Chari
        'ME', // Mayo-Kebbi Est
        'MO', // Mayo-Kebbi Ouest
        'ND', // Ville de N'Djamena
        'OD', // Ouaddaï
        'SA', // Salamat
        'SI', // Sila
        'TA', // Tandjile
        'TI', // Tibesti
        'WF', // Wadi Fira
        'EN', // Ennedi
    );

    public $compareIdentical = true;
}
