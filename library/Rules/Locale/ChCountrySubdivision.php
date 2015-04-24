<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Switzerland country subdivision.
 *
 * ISO 3166-1 alpha-2: CH
 *
 * @link http://www.geonames.org/CH/administrative-division-switzerland.html
 */
class ChCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AG', // Aargau
        'AI', // Appenzell Innerhoden
        'AR', // Appenzell Ausserrhoden
        'BE', // Bern
        'BL', // Basel-Landschaft
        'BS', // Basel-Stadt
        'FR', // Fribourg
        'GE', // Geneva
        'GL', // Glarus
        'GR', // Graubunden
        'JU', // Jura
        'LU', // Lucerne
        'NE', // Neuchâtel
        'NW', // Nidwalden
        'OW', // Obwalden
        'SG', // St. Gallen
        'SH', // Schaffhausen
        'SO', // Solothurn
        'SZ', // Schwyz
        'TG', // Thurgau
        'TI', // Ticino
        'UR', // Uri
        'VD', // Vaud
        'VS', // Valais
        'ZG', // Zug
        'ZH', // Zurich
    );

    public $compareIdentical = true;
}
