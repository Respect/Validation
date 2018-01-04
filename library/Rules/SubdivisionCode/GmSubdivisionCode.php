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
 * Validator for Gambia subdivision code.
 *
 * ISO 3166-1 alpha-2: GM
 *
 * @see http://www.geonames.org/GM/administrative-division-gambia.html
 */
class GmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Banjul
        'L', // Lower River
        'M', // Central River
        'N', // North Bank
        'U', // Upper River
        'W', // Western
    ];

    public $compareIdentical = true;
}
