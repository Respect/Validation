<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Yemen country subdivision.
 *
 * ISO 3166-1 alpha-2: YE
 *
 * @link http://www.geonames.org/YE/administrative-division-yemen.html
 */
class YeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AB', // Abyan
        'AD', // Adan
        'AM', // Amran
        'BA', // Al Bayda
        'DA', // Ad Dali
        'DH', // Dhamar
        'HD', // Hadramawt
        'HJ', // Hajjah
        'HU', // Al Hudaydah
        'IB', // Ibb
        'JA', // Al Jawf
        'LA', // Lahij
        'MA', // Ma'rib
        'MR', // Al Mahrah
        'MW', // Al Mahwit
        'RA', // Raymah
        'SA', // Amanat Al Asimah
        'SD', // Sa'dah
        'SH', // Shabwah
        'SN', // San'a
        'TA', // Ta'izz
    );

    public $compareIdentical = true;
}
