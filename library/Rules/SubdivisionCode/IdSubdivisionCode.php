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
 * Validator for Indonesia subdivision code.
 *
 * ISO 3166-1 alpha-2: ID
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class IdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AC', // Aceh
        'BA', // Bali
        'BB', // Bangka Belitung
        'BE', // Bengkulu
        'BT', // Banten
        'GO', // Gorontalo
        'IJ', // Papua
        'JA', // Jambi
        'JB', // Jawa Barat
        'JI', // Jawa Timur
        'JK', // Jakarta Raya
        'JT', // Jawa Tengah
        'JW', // Jawa
        'KA', // Kalimantan
        'KB', // Kalimantan Barat
        'KI', // Kalimantan Timur
        'KR', // Kepulauan Riau
        'KS', // Kalimantan Selatan
        'KT', // Kalimantan Tengah
        'LA', // Lampung
        'MA', // Maluku
        'ML', // Maluku
        'MU', // Maluku Utara
        'NB', // Nusa Tenggara Barat
        'NT', // Nusa Tenggara Timur
        'NU', // Nusa Tenggara
        'PA', // Papua
        'PB', // Papua Barat
        'RI', // Riau
        'SA', // Sulawesi Utara
        'SB', // Sumatra Barat
        'SG', // Sulawesi Tenggara
        'SL', // Sulawesi
        'SM', // Sumatera
        'SN', // Sulawesi Selatan
        'SR', // Sulawesi Barat
        'SS', // Sumatra Selatan
        'ST', // Sulawesi Tengah
        'SU', // Sumatera Utara
        'YO', // Yogyakarta
    ];

    public $compareIdentical = true;
}
