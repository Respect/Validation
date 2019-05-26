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
 * Validator for Cayman Islands subdivision code.
 *
 * ISO 3166-1 alpha-2: KY
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'CR', // Creek
        'EA', // Eastern
        'ML', // Midland
        'SK', // Stake Bay
        'SP', // Spot Bay
        'ST', // South Town
        'WD', // West End
        'WN', // Western
    ];

    public $compareIdentical = true;
}
