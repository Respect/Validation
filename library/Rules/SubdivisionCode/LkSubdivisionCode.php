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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class LkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Basnāhira paḷāta
        '11', // Kŏḷamba
        '12', // Gampaha
        '13', // Kaḷutara
        '2', // Madhyama paḷāta
        '21', // Mahanuvara
        '22', // Mātale
        '23', // Nuvara Ĕliya
        '3', // Dakuṇu paḷāta
        '31', // Gālla
        '32', // Mātara
        '33', // Hambantŏṭa
        '4', // Uturu paḷāta
        '41', // Yāpanaya
        '42', // Kilinŏchchi
        '43', // Mannārama
        '44', // Vavuniyāva
        '45', // Mulativ
        '5', // Næ̆gĕnahira paḷāta
        '51', // Maḍakalapuva
        '52', // Ampāara
        '53', // Trikuṇāmalaya
        '6', // Vayamba paḷāta
        '61', // Kuruṇægala
        '62', // Puttalama
        '7', // Uturumæ̆da paḷāta
        '71', // Anurādhapura
        '72', // Pŏḷŏnnaruva
        '8', // Ūva paḷāta
        '81', // Badulla
        '82', // Mŏṇarāgala
        '9', // Sabaragamuva paḷāta
        '91', // Ratnapura
        '92', // Kægalla
    ];

    public $compareIdentical = true;
}
