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
 * Validator for Norway subdivision code.
 *
 * ISO 3166-1 alpha-2: NO
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class NoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Østfold
        '02', // Akershus
        '03', // Oslo
        '04', // Hedmark
        '05', // Oppland
        '06', // Buskerud
        '07', // Vestfold
        '08', // Telemark
        '09', // Aust-Agder
        '10', // Vest-Agder
        '11', // Rogaland
        '12', // Hordaland
        '14', // Sogn og Fjordane
        '15', // Møre og Romsdal
        '16', // Sør-Trøndelag
        '17', // Nord-Trøndelag
        '18', // Nordland
        '19', // Troms
        '20', // Finnmark
        '21', // Svalbard (Arctic Region)
        '22', // Jan Mayen (Arctic Region)
    ];

    public $compareIdentical = true;
}
