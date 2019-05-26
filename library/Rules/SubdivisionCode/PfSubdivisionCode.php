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
 * Validator for French Polynesia subdivision code.
 *
 * ISO 3166-1 alpha-2: PF
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'I', // Austral Islands
        'M', // Marquesas Islands
        'S', // Iles Sous-le-Vent
        'T', // Tuamotu-Gambier
        'V', // Iles du Vent
    ];

    public $compareIdentical = true;
}
