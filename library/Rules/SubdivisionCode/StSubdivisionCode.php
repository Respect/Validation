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
 * Validator for São Tomé and Príncipe subdivision code.
 *
 * ISO 3166-1 alpha-2: ST
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class StSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'P', // Príncipe
        'S', // São Tomé
    ];

    public $compareIdentical = true;
}
