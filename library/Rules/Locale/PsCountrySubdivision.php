<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Palestine country subdivision.
 *
 * ISO 3166-1 alpha-2: PS
 *
 * @link http://www.geonames.org/PS/administrative-division-palestine.html
 */
class PsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DEB', // Bethlehem [conventional] / Bayt Laḩm [Arabic]
        'DEB', // Deir El Balah [conventional] /Dayr al Balaḩ[Arabic]
        'GZA', // Gaza [conventional] / Ghazzah[Arabic]
        'HBN', // Hebron [conventional] / Al Khalīl [Arabic]
        'JEM', // Jerusalem [conventional] / Al Quds [Arabic]
        'JEN', // Jenin [conventional] / Janīn [Arabic]
        'JRH', // Jericho [conventional] / Arīḩā wal Aghwār [Arabic]
        'KYS', // Khan Yunis [conventional] / Khān Yūnis[Arabic]
        'NBS', // Nablus [conventional] / Nāblus [Arabic]
        'NGZ', // North Gaza [conventional] / Shamāl Ghazzah[Arabic]
        'QQA', // Qalqiyah [conventional] / Qalqīlyah [Arabic]
        'RBH', // Ramallah and Al Birah [conventional] / Rām Allāh wal Bīrah [Arabic]
        'RFH', // Rafah [conventional] / Rafaḩ[Arabic]
        'SLT', // Salfit [conventional] / Salfīt [Arabic]
        'TBS', // Tubas [conventional] / Ţūbās [Arabic]
        'TKM', // Tulkarm [conventional] /Ţūlkarm [Arabic]
    );

    public $compareIdentical = true;
}
