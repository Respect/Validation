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
 * Validates whether an input is subdivision code of Indonesia or not.
 *
 * ISO 3166-1 alpha-2: ID
 *
 * @see http://www.geonames.org/ID/administrative-division-indonesia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
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
           'JW', // Java
           'KA', // Kalimantan
           'KB', // Kalimantan Barat
           'KI', // Kalimantan Timur
           'KR', // Kepulauan Riau
           'KS', // Kalimantan Selatan
           'KT', // Kalimantan Tengah
           'KU', // Kalimantan Utara
           'LA', // Lampung
           'MA', // Maluku
           'ML', // Maluku
           'MU', // Maluku Utara
           'NB', // Nusa Tenggara Barat
           'NT', // Nusa Tenggara Timur
           'NU', // Nusa Tenggara
           'PA', // Papua
           'PB', // Papua Barat
           'PP', // Papua
           'RI', // Riau
           'SA', // Sulawesi Utara
           'SB', // Sumatera Barat
           'SG', // Sulawesi Tenggara
           'SL', // Sulawesi
           'SM', // Sumatera
           'SN', // Sulawesi Selatan
           'SR', // Sulawesi Barat
           'SS', // Sumatera Selatan
           'ST', // Sulawesi Tengah
           'SU', // Sumatera Utara
           'YO', // Yogyakarta
       ];
    }
}
