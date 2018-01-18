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
 * Validates whether an input is subdivision code of New Zealand or not.
 *
 * ISO 3166-1 alpha-2: NZ
 *
 * @see http://www.geonames.org/NZ/administrative-division-new-zealand.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NzSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AUK', // Auckland
           'BOP', // Bay of Plenty
           'CAN', // Canterbury
           'CIT', // Chatham Islands
           'GIS', // Gisborne
           'HKB', // Hawke's Bay
           'MBH', // Marlborough
           'MWT', // Manawatu-Wanganui
           'NSN', // Nelson
           'NTL', // Northland
           'OTA', // Otago
           'STL', // Southland
           'TAS', // Tasman
           'TKI', // Taranaki
           'WGN', // Wellington
           'WKO', // Waikato
           'WTC', // West Coast
       ];
    }
}
