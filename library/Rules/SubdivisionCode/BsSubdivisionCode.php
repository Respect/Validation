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
 * Validates whether an input is subdivision code of Bahamas or not.
 *
 * ISO 3166-1 alpha-2: BS
 *
 * @see http://www.geonames.org/BS/administrative-division-bahamas.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BsSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AK', // Acklins Islands
           'BI', // Bimini and Cat Cay
           'BP', // Black Point
           'BY', // Berry Islands
           'CE', // Central Eleuthera
           'CI', // Cat Island
           'CK', // Crooked Island and Long Cay
           'CO', // Central Abaco
           'CS', // Central Andros
           'EG', // East Grand Bahama
           'EX', // Exuma
           'FP', // City of Freeport
           'GC', // Grand Cay
           'HI', // Harbour Island
           'HT', // Hope Town
           'IN', // Inagua
           'LI', // Long Island
           'MC', // Mangrove Cay
           'MG', // Mayaguana
           'MI', // Moore's Island
           'NE', // North Eleuthera
           'NO', // North Abaco
           'NP', // New Providence
           'NS', // North Andros
           'RC', // Rum Cay
           'RI', // Ragged Island
           'SA', // South Andros
           'SE', // South Eleuthera
           'SO', // South Abaco
           'SS', // San Salvador
           'SW', // Spanish Wells
           'WG', // West Grand Bahama
       ];
    }
}
