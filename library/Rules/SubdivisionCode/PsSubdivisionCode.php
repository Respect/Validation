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
 * Validator for Palestine subdivision code.
 *
 * ISO 3166-1 alpha-2: PS
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BTH', // Bethlehem
        'DEB', // Deir El Balah
        'GZA', // Gaza
        'HBN', // Hebron
        'JEM', // Jerusalem
        'JEN', // Jenin
        'JRH', // Jericho - Al Aghwar
        'KYS', // Khan Yunis
        'NBS', // Nablus
        'NGZ', // North Gaza
        'QQA', // Qalqilya
        'RBH', // Ramallah
        'RFH', // Rafah
        'SLT', // Salfit
        'TBS', // Tubas
        'TKM', // Tulkarm
    ];

    public $compareIdentical = true;
}
