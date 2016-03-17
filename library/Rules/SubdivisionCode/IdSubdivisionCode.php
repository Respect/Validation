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
 * @link http://www.geonames.org/ID/administrative-division-indonesia.html
 */
class IdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'IJ', // Papua
        'JW', // Java
        'KA', // Kalimantan
        'MA', // Maluku
        'NU', // Nusa Tenggara
        'SL', // Sulawesi
        'SM', // Sumatera
        'AC', // Aceh
        'BA', // Bali
        'BB', // Bangka-Belitung
        'BE', // Bengkulu
        'BT', // Banten
        'GO', // Gorontalo
        'JA', // Jambi
        'JB', // Jawa Barat
        'JI', // Jawa Timur
        'JK', // Jakarta Raya
        'JT', // Jawa Tengah
        'KB', // Kalimantan Barat
        'KI', // Kalimantan Timur
        'KI', // Kalimantan Utara
        'KR', // Kepulauan Riau
        'KS', // Kalimantan Selatan
        'KT', // Kalimantan Tengah
        'LA', // Lampung
        'MA', // Maluku
        'MU', // Maluku Utara
        'NB', // Nusa Tenggara Barat
        'NT', // Nusa Tenggara Timur
        'PA', // Papua
        'PB', // Papua Barat
        'RI', // Riau
        'SA', // Sulawesi Utara
        'SB', // Sumatera Barat
        'SG', // Sulawesi Tenggara
        'SN', // Sulawesi Selatan
        'SR', // Sulawesi Barat
        'SS', // Sumatera Selatan
        'ST', // Sulawesi Tengah
        'SU', // Sumatera Utara
        'YO', // Yogyakarta
    ];

    public $compareIdentical = true;
}
