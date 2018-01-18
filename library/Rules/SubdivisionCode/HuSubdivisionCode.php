<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Hungary or not.
 *
 * ISO 3166-1 alpha-2: HU
 *
 * @see http://www.geonames.org/HU/administrative-division-hungary.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class HuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BA', // Baranya megye
           'BC', // Békéscsaba
           'BE', // Békés megye
           'BK', // Bács-Kiskun megye
           'BU', // Budapest főváros
           'BZ', // Borsod-Abaúj-Zemplén megye
           'CS', // Csongrád megye
           'DE', // Debrecen
           'DU', // Dunaújváros
           'EG', // Eger
           'ER', // Erd
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
       ];
    }
}
