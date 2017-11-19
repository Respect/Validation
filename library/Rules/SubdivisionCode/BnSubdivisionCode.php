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
 * Validator for Brunei subdivision code.
 *
 * ISO 3166-1 alpha-2: BN
 *
 * @see http://www.geonames.org/BN/administrative-division-brunei.html
 */
class BnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BE', // Belait
        'BM', // Brunei and Muara
        'TE', // Temburong
        'TU', // Tutong
    ];

    public $compareIdentical = true;
}
