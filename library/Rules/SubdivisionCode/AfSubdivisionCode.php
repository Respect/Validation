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
 * Validator for Afghanistan subdivision code.
 *
 * ISO 3166-1 alpha-2: AF
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BAL', // Balkh
        'BAM', // Bāmyān
        'BDG', // Bādghīs
        'BDS', // Badakhshān
        'BGL', // Baghlān
        'DAY', // Dāykundī
        'FRA', // Farāh
        'FYB', // Fāryāb
        'GHA', // Ghaznī
        'GHO', // Ghōr
        'HEL', // Helmand
        'HER', // Herāt
        'JOW', // Jowzjān
        'KAB', // Kābul
        'KAN', // Kandahār
        'KAP', // Kāpīsā
        'KDZ', // Kunduz
        'KHO', // Khōst
        'KNR', // Kunar
        'LAG', // Laghmān
        'LOG', // Lōgar
        'NAN', // Nangarhār
        'NIM', // Nīmrōz
        'NUR', // Nūristān
        'PAN', // Panjshayr
        'PAR', // Parwān
        'PIA', // Paktiyā
        'PKA', // Paktīkā
        'SAM', // Samangān
        'SAR', // Sar-e Pul
        'TAK', // Takhār
        'URU', // Uruzgān
        'WAR', // Wardak
        'ZAB', // Zābul
    ];

    public $compareIdentical = true;
}
