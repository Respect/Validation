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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KhSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Banteay Mean Chey
        '10', // Krachoh
        '11', // Mondol Kiri
        '12', // Phnom Penh
        '13', // Preah Vihear
        '14', // Prey Veaeng
        '15', // Pousaat
        '16', // Rotanak Kiri
        '17', // Siem Reab
        '18', // Krong Preah Sihanouk
        '19', // Stueng Traeng
        '2', // Battambang
        '20', // Svaay Rieng
        '21', // Taakaev
        '22', // Otdar Mean Chey
        '23', // Krong Kaeb
        '24', // Krong Pailin
        '3', // Kampong Cham
        '4', // Kampong Chhnang
        '5', // Kampong Speu
        '6', // Kampong Thom
        '7', // Kampot
        '8', // Kandal
        '9', // Kach Kong
    ];

    public $compareIdentical = true;
}
