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
 * Validator for Somalia subdivision code.
 *
 * ISO 3166-1 alpha-2: SO
 *
 * @link http://www.geonames.org/SO/administrative-division-somalia.html
 */
class SoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AW', // Awdal
        'BK', // Bakool
        'BN', // Banaadir
        'BR', // Bari
        'BY', // Bay
        'GA', // Galguduud
        'GE', // Gedo
        'HI', // Hiiraan
        'JD', // Jubbada Dhexe
        'JH', // Jubbada Hoose
        'MU', // Mudug
        'NU', // Nugaal
        'SA', // Sanaag
        'SD', // Shabeellaha Dhexe
        'SH', // Shabeellaha Hoose
        'SO', // Sool
        'TO', // Togdheer
        'WO', // Woqooyi Galbeed
    ];

    public $compareIdentical = true;
}
