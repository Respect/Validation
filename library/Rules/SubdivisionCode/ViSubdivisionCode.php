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
 * Validator for U.S. Virgin Islands subdivision code.
 *
 * ISO 3166-1 alpha-2: VI
 *
 * @link http://www.geonames.org/VI/administrative-division-u-s-virgin-islands.html
 */
class ViSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'C', // Saint Croix
        'J', // Saint John
        'T', // Saint Thomas
    ];

    public $compareIdentical = true;
}
