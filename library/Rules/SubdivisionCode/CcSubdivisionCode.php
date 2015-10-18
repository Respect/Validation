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
 * Validator for Cocos [Keeling] Islands subdivision code.
 *
 * ISO 3166-1 alpha-2: CC
 *
 * @link http://www.geonames.org/CC/administrative-division-cocos-islands.html
 */
class CcSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'D', // Direction Island
        'H', // Home Island
        'O', // Horsburgh Island
        'S', // South Island
        'W', // West Island
    ];

    public $compareIdentical = true;
}
