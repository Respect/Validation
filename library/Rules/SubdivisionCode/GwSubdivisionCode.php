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
 * Validator for Guinea-Bissau subdivision code.
 *
 * ISO 3166-1 alpha-2: GW
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Bafatá
        'BL', // Bolama
        'BM', // Biombo
        'BS', // Bissau
        'CA', // Cacheu
        'GA', // Gabú
        'L', // Leste
        'N', // Norte
        'OI', // Oio
        'QU', // Quinara
        'S', // Sul
        'TO', // Tombali
    ];

    public $compareIdentical = true;
}
