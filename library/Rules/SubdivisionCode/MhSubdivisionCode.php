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
 * Validates whether an input is subdivision code of Marshall Islands or not.
 *
 * ISO 3166-1 alpha-2: MH
 *
 * @see http://www.geonames.org/MH/administrative-division-marshall-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MhSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'ALK', // Ailuk
           'ALL', // Ailinglaplap
           'ARN', // Arno
           'AUR', // Aur
           'EBO', // Ebon
           'ENI', // Enewetak
           'JAB', // Jabat
           'JAL', // Jaluit
           'KIL', // Kili
           'KWA', // Kwajalein
           'L', // Ralik chain
           'LAE', // Lae
           'LIB', // Lib
           'LIK', // Likiep
           'MAJ', // Majuro
           'MAL', // Maloelap
           'MEJ', // Mejit
           'MIL', // Mili
           'NMK', // Namorik
           'NMU', // Namu
           'RON', // Rongelap
           'T', // Ratak chain
           'UJA', // Ujae
           'UTI', // Utirik
           'WTH', // Wotho
           'WTJ', // Wotje
       ];
    }
}
