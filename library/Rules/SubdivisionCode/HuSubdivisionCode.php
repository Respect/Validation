<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Hungary subdivision code.
 *
 * ISO 3166-1 alpha-2: HU
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class HuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Baranya
        'BC', // Békéscsaba
        'BE', // Békés
        'BK', // Bács-Kiskun
        'BU', // Budapest
        'BZ', // Borsod-Abaúj-Zemplén
        'CS', // Csongrád
        'DE', // Debrecen
        'DU', // Dunaújváros
        'EG', // Eger
        'ER', // Érd
        'FE', // Fejér
        'GS', // Győr-Moson-Sopron
        'GY', // Győr
        'HB', // Hajdú-Bihar
        'HE', // Heves
        'HV', // Hódmezővásárhely
        'JN', // Jász-Nagykun-Szolnok
        'KE', // Komárom-Esztergom
        'KM', // Kecskemét
        'KV', // Kaposvár
        'MI', // Miskolc
        'NK', // Nagykanizsa
        'NO', // Nógrád
        'NY', // Nyíregyháza
        'PE', // Pest
        'PS', // Pécs
        'SD', // Szeged
        'SF', // Székesfehérvár
        'SH', // Szombathely
        'SK', // Szolnok
        'SN', // Sopron
        'SO', // Somogy
        'SS', // Szekszárd
        'ST', // Salgótarján
        'SZ', // Szabolcs-Szatmár-Bereg
        'TB', // Tatabánya
        'TO', // Tolna
        'VA', // Vas
        'VE', // Veszprém (county)
        'VM', // Veszprém
        'ZA', // Zala
        'ZE', // Zalaegerszeg
    ];

    public $compareIdentical = true;
}
