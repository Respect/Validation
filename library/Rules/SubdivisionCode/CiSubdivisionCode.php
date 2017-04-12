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
 * Validator for Ivory Coast subdivision code.
 *
 * ISO 3166-1 alpha-2: CI
 *
 * @link http://www.geonames.org/CI/administrative-division-ivory-coast.html
 */
class CiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AB', // Abidjan
        'BS', // Bas-Sassandra
        'CM', // Comoé
        'DN', // Denguélé
        'GD', // Gôh-Djiboua
        'LC', // Lacs
        'LG', // Lagunes
        'MG', // Montagnes
        'SM', // Sassandra-Marahoué
        'SV', // Savanes
        'VB', // Vallée du Bandama
        'WR', // Woroba
        'YM', // Yamoussoukro Autonomous District
        'ZZ', // Zanzan
    ];

    public $compareIdentical = true;
}
