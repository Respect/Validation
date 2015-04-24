<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Kazakhstan country subdivision.
 *
 * ISO 3166-1 alpha-2: KZ
 *
 * @link http://www.geonames.org/KZ/administrative-division-kazakhstan.html
 */
class KzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AKM', // Aqmola
        'AKT', // Aqtobe
        'ALA', // Almaty
        'ALM', // Almaty
        'AST', // Astana
        'ATY', // Atyrau
        'BAY', // Baykonyr
        'KAR', // Qaraghandy
        'KUS', // Qustanay
        'KZY', // Qyzylorda
        'MAN', // Mangghystau
        'PAV', // Paylodar
        'SEV', // Soltustik Qazaqstan
        'VOS', // Shyghys Qazaqstan
        'YUZ', // Ongtustik Qazaqstan
        'ZAP', // Baty Qazaqstan
        'ZHA', // Zhambyl
    );

    public $compareIdentical = true;
}
