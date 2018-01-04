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
 * Validator for South Sudan subdivision code.
 *
 * ISO 3166-1 alpha-2: SS
 *
 * @see http://www.geonames.org/SS/administrative-division-south-sudan.html
 */
class SsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BN', // Northern Bahr el Ghazal
        'BW', // Western Bahr el Ghazal
        'EC', // Central Equatoria
        'EE', // Eastern Equatoria
        'EW', // Western Equatoria
        'JG', // Jonglei
        'LK', // Lakes
        'NU', // Upper Nile
        'UY', // Unity
        'WR', // Warrap
    ];

    public $compareIdentical = true;
}
