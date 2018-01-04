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
 * Validator for Benin subdivision code.
 *
 * ISO 3166-1 alpha-2: BJ
 *
 * @see http://www.geonames.org/BJ/administrative-division-benin.html
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
        'OU', // Oueme
        'PL', // Plateau
        'ZO', // Zou
    ];

    public $compareIdentical = true;
}
