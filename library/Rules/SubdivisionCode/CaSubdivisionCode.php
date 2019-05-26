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
 * Validator for Canada subdivision code.
 *
 * ISO 3166-1 alpha-2: CA
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Alberta
        'BC', // British Columbia
        'MB', // Manitoba
        'NB', // New Brunswick
        'NL', // Newfoundland and Labrador
        'NS', // Nova Scotia
        'NT', // Northwest Territories
        'NU', // Nunavut
        'ON', // Ontario
        'PE', // Prince Edward Island
        'QC', // Quebec
        'SK', // Saskatchewan
        'YT', // Yukon Territory
    ];

    public $compareIdentical = true;
}
