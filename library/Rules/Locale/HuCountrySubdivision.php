<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Hungary country subdivision.
 *
 * ISO 3166-1 alpha-2: HU
 *
 * @link http://www.geonames.org/HU/administrative-division-hungary.html
 */
class HuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BA', // Baranya megye
        'BC', // Békéscsaba
        'BE', // Békés megye
        'BK', // Bács-Kiskun megye
        'BU', // Budapest főváros
        'BZ', // Borsod-Abaúj-Zemplén megye
        'CS', // Csongrád megye
        'DE', // Debrecen
        'DU', // Dunaújváros
        'EG', // Erd
        'ER', // Eger
        'FE', // Fejér megye
        'GS', // Győr-Moson-Sopron megye
        'GY', // Győr
        'HB', // Hajdú-Bihar megye
        'HE', // Heves megye
        'HV', // Hódmezővásárhely
        'JN', // Jász-Nagykun-Szolnok megye
        'KE', // Komárom-Esztergom megye
        'KM', // Kecskemét
        'KV', // Kaposvár
        'MI', // Miskolc
        'NK', // Nagykanizsa
        'NO', // Nógrád megye
        'NY', // Nyíregyháza
        'PE', // Pest megye
        'PS', // Pécs
        'SD', // Szeged
        'SF', // Székesfehérvár
        'SH', // Szombathely
        'SK', // Szolnok
        'SN', // Sopron
        'SO', // Somogy megye
        'SS', // Szekszárd
        'ST', // Salgótarján
        'SZ', // Szabolcs-Szatmár-Bereg megye
        'TB', // Tatabánya
        'TO', // Tolna megye
        'VA', // Vas megye
        'VE', // Veszprém megye
        'VM', // Veszprém
        'ZA', // Zala megye
        'ZE', // Zalaegerszeg
    );

    public $compareIdentical = true;
}
