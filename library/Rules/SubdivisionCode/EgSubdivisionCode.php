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
 * Validator for Egypt subdivision code.
 *
 * ISO 3166-1 alpha-2: EG
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class EgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ALX', // Al Iskandarīyah
        'ASN', // Aswān
        'AST', // Asyūt
        'BA', // Al Bahr al Ahmar
        'BH', // Al Buhayrah
        'BNS', // Banī Suwayf
        'C', // Al Qāhirah
        'DK', // Ad Daqahlīyah
        'DT', // Dumyāt
        'FYM', // Al Fayyūm
        'GH', // Al Gharbīyah
        'GZ', // Al Jīzah
        'HU', // Ḩulwān
        'IS', // Al Ismā`īlīyah
        'JS', // Janūb Sīnā'
        'KB', // Al Qalyūbīyah
        'KFS', // Kafr ash Shaykh
        'KN', // Qinā
        'MN', // Al Minyā
        'MNF', // Al Minūfīyah
        'MT', // Matrūh
        'PTS', // Būr Sa`īd
        'SHG', // Sūhāj
        'SHR', // Ash Sharqīyah
        'SIN', // Shamal Sīnā'
        'SU', // As Sādis min Uktūbar
        'SUZ', // As Suways
        'WAD', // Al Wādī al Jadīd
    ];

    public $compareIdentical = true;
}
