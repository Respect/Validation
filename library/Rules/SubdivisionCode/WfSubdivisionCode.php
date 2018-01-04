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
 * Validator for Wallis and Futuna subdivision code.
 *
 * ISO 3166-1 alpha-2: WF
 *
 * @see http://www.geonames.org/WF/administrative-division-wallis-and-futuna.html
 */
class WfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AL', // Alo
        'SG', // Sigave
        'UV', // ʻUvea
    ];

    public $compareIdentical = true;
}
