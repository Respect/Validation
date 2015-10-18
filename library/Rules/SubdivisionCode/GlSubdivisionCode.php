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
 * Validator for Greenland subdivision code.
 *
 * ISO 3166-1 alpha-2: GL
 *
 * @link http://www.geonames.org/GL/administrative-division-greenland.html
 */
class GlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'KU', // Kujalleq
        'QA', // Qaasuitsup
        'QE', // Qeqqata
        'SM', // Sermersooq
    ];

    public $compareIdentical = true;
}
