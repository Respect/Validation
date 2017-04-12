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
 * Validator for Cambodia subdivision code.
 *
 * ISO 3166-1 alpha-2: KH
 *
 * @link http://www.geonames.org/KH/administrative-division-cambodia.html
 */
class KhSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Banteay Mean Choay
        '10', // Kratie
        '11', // Mondul Kiri
        '12', // Phnom Penh
        '13', // Preah Vihear
        '14', // Prey Veng
        '15', // Pursat
        '16', // Rôtânôkiri
        '17', // Siemreap
        '18', // Preah Seihanu (Kompong Som or Sihanoukville)
        '19', // Stung Treng
        '2', // Battambang
        '20', // Svay Rieng
        '21', // Takeo
        '22', // Otdar Mean Choay
        '23', // Keb
        '24', // Pailin
        '25', // Tboung Khmum
        '3', // Kampong Cham
        '4', // Kampong Chhnang
        '5', // Kampong Speu
        '6', // Kampong Thom
        '7', // Kampot
        '8', // Kandal
        '9', // Kaoh Kong
    ];

    public $compareIdentical = true;
}
