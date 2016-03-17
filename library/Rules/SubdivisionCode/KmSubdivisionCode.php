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
 * Validator for Comoros subdivision code.
 *
 * ISO 3166-1 alpha-2: KM
 *
 * @link http://www.geonames.org/KM/administrative-division-comoros.html
 */
class KmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Anjouan
        'G', // Grande Comore
        'M', // Moheli
    ];

    public $compareIdentical = true;
}
