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
 * Validator for Benin subdivision code.
 *
 * ISO 3166-1 alpha-2: BJ
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BjSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AK', // Atakora
        'AL', // Alibori
        'AQ', // Atlantique
        'BO', // Borgou
        'CO', // Collines
        'DO', // Donga
        'KO', // Kouffo
        'LI', // Littoral
        'MO', // Mono
        'OU', // Ouémé
        'PL', // Plateau
        'ZO', // Zou
    ];

    public $compareIdentical = true;
}
