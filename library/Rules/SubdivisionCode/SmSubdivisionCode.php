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
 * Validator for San Marino subdivision code.
 *
 * ISO 3166-1 alpha-2: SM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Acquaviva
        '02', // Chiesanuova
        '03', // Domagnano
        '04', // Faetano
        '05', // Fiorentino
        '06', // Borgo Maggiore
        '07', // San Marino
        '08', // Montegiardino
        '09', // Serravalle
    ];

    public $compareIdentical = true;
}
