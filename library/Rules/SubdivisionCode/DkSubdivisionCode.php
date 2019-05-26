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
 * Validator for Denmark subdivision code.
 *
 * ISO 3166-1 alpha-2: DK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class DkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '81', // Nordjylland
        '82', // Midtjylland
        '83', // Syddanmark
        '84', // Hovedstaden
        '85', // Sjælland
    ];

    public $compareIdentical = true;
}
