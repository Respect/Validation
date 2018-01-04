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
 * Validator for Austria subdivision code.
 *
 * ISO 3166-1 alpha-2: AT
 *
 * @see http://www.geonames.org/AT/administrative-division-austria.html
 */
class AtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Burgenland
        '2', // Karnten
        '3', // Niederosterreich
        '4', // Oberosterreich
        '5', // Salzburg
        '6', // Steiermark
        '7', // Tirol
        '8', // Vorarlberg
        '9', // Wien
    ];

    public $compareIdentical = true;
}
