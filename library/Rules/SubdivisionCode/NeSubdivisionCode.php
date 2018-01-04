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
 * Validator for Niger subdivision code.
 *
 * ISO 3166-1 alpha-2: NE
 *
 * @see http://www.geonames.org/NE/administrative-division-niger.html
 */
class NeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Agadez
        '2', // Diffa
        '3', // Dosso
        '4', // Maradi
        '5', // Tahoua
        '6', // Tillabéri
        '7', // Zinder
        '8', // Niamey
    ];

    public $compareIdentical = true;
}
