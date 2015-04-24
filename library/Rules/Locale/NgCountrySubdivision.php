<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Nigeria country subdivision.
 *
 * ISO 3166-1 alpha-2: NG
 *
 * @link http://www.geonames.org/NG/administrative-division-nigeria.html
 */
class NgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AB', // Abia
        'AD', // Adamawa
        'AK', // Akwa Ibom
        'AN', // Anambra
        'BA', // Bauchi
        'BE', // Benue
        'BO', // Borno
        'BY', // Bayelsa
        'CR', // Cross River
        'DE', // Delta
        'EB', // Ebonyi
        'ED', // Edo
        'EK', // Ekiti
        'EN', // Enugu
        'FC', // Federal Capital Territory
        'GO', // Gombe
        'IM', // Imo
        'JI', // Jigawa
        'KD', // Kaduna
        'KE', // Kebbi
        'KN', // Kano
        'KO', // Kogi
        'KT', // Katsina
        'KW', // Kwara
        'LA', // Lagos
        'NA', // Nassarawa
        'NI', // Niger
        'OG', // Ogun
        'ON', // Ondo
        'OS', // Osun
        'OY', // Oyo
        'PL', // Plateau
        'RI', // Rivers
        'SO', // Sokoto
        'TA', // Taraba
        'YO', // Yobe
        'ZA', // Zamfara
    );

    public $compareIdentical = true;
}
