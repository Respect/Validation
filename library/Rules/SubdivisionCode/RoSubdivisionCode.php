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
 * Validator for Romania subdivision code.
 *
 * ISO 3166-1 alpha-2: RO
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class RoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Alba
        'AG', // Argeș
        'AR', // Arad
        'B', // București
        'BC', // Bacău
        'BH', // Bihor
        'BN', // Bistrița-Năsăud
        'BR', // Brăila
        'BT', // Botoșani
        'BV', // Brașov
        'BZ', // Buzău
        'CJ', // Cluj
        'CL', // Călărași
        'CS', // Caraș-Severin
        'CT', // Constanța
        'CV', // Covasna
        'DB', // Dâmbovița
        'DJ', // Dolj
        'GJ', // Gorj
        'GL', // Galați
        'GR', // Giurgiu
        'HD', // Hunedoara
        'HR', // Harghita
        'IF', // Ilfov
        'IL', // Ialomița
        'IS', // Iași
        'MH', // Mehedinți
        'MM', // Maramureș
        'MS', // Mureș
        'NT', // Neamț
        'OT', // Olt
        'PH', // Prahova
        'SB', // Sibiu
        'SJ', // Sălaj
        'SM', // Satu Mare
        'SV', // Suceava
        'TL', // Tulcea
        'TM', // Timiș
        'TR', // Teleorman
        'VL', // Vâlcea
        'VN', // Vrancea
        'VS', // Vaslui
    ];

    public $compareIdentical = true;
}
