<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Belize subdivision code.
 *
 * ISO 3166-1 alpha-2: BZ
 *
 * @see http://www.geonames.org/BZ/administrative-division-belize.html
 */
class BzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BZ', // Belize District
        'CY', // Cayo District
        'CZL', // Corozal District
        'OW', // Orange Walk District
        'SC', // Stann Creek District
        'TOL', // Toledo District
    ];

    public $compareIdentical = true;
}
