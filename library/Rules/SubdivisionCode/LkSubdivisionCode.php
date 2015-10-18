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
 * Validator for Sri Lanka subdivision code.
 *
 * ISO 3166-1 alpha-2: LK
 *
 * @link http://www.geonames.org/LK/administrative-division-sri-lanka.html
 */
class LkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Western
        '2', // Central
        '3', // Southern
        '4', // Northern
        '5', // Eastern
        '6', // North Western
        '7', // North Central
        '8', // Uva
        '9', // Sabaragamuwa
        '11', // Kŏḷamba
        '12', // Gampaha
        '13', // Kaḷutara
        '21', // Mahanuvara
        '22', // Mātale
        '23', // Nuvara Ĕliya
        '31', // Gālla
        '32', // Mātara
        '33', // Hambantŏṭa
        '41', // Yāpanaya
        '42', // Kilinŏchchi
        '43', // Mannārama
        '44', // Vavuniyāva
        '45', // Mulativ
        '51', // Maḍakalapuva
        '52', // Ampāra
        '53', // Trikuṇāmalaya
        '61', // Kuruṇægala
        '62', // Puttalama
        '71', // Anurādhapura
        '72', // Pŏḷŏnnaruva
        '81', // Badulla
        '82', // Mŏṇarāgala
        '91', // Ratnapura
        '92', // Kægalla
    ];

    public $compareIdentical = true;
}
