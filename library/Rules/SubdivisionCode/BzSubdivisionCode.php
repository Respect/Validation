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
 * Validator for Belize subdivision code.
 *
 * ISO 3166-1 alpha-2: BZ
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BZ', // Belize
        'CY', // Cayo
        'CZL', // Corozal
        'OW', // Orange Walk
        'SC', // Stann Creek
        'TOL', // Toledo
    ];

    public $compareIdentical = true;
}
