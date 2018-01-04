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
 * Validator for Tokelau subdivision code.
 *
 * ISO 3166-1 alpha-2: TK
 *
 * @see http://www.geonames.org/TK/administrative-division-tokelau.html
 */
class TkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Atafu
        'F', // Fakaofo
        'N', // Nukunonu
    ];

    public $compareIdentical = true;
}
