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
 * Validator for Cook Islands subdivision code.
 *
 * ISO 3166-1 alpha-2: CK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AI', // Aitutaki
        'AT', // Atiu
        'MA', // Manuae
        'MG', // Mangaia
        'MK', // Manihiki
        'MT', // Mitiaro
        'MU', // Mauke
        'NI', // Nassau Island
        'PA', // Palmerston
        'PE', // Penrhyn
        'PU', // Pukapuka
        'RK', // Rakahanga
        'RR', // Rarotonga
        'SU', // Surwarrow
        'TA', // Takutea
    ];

    public $compareIdentical = true;
}
