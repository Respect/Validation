<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Belgium country subdivision.
 *
 * ISO 3166-1 alpha-2: BE
 *
 * @link http://www.geonames.org/BE/administrative-division-belgium.html
 */
class BeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BRU', // Brussels
        'VLG', // Flanders
        'WAL', // Wallonia
        'BRU', // Brussels
        'VAN', // Antwerpen
        'VBR', // Vlaams Brabant
        'VLI', // Limburg
        'VOV', // Oost-Vlaanderen
        'VWV', // West-Vlaanderen
        'WBR', // Brabant Wallon
        'WHT', // Hainaut
        'WLG', // Liege
        'WLX', // Luxembourg
        'WNA', // Namur
    );

    public $compareIdentical = true;
}
