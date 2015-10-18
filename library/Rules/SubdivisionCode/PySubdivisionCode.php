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
 * Validator for Paraguay subdivision code.
 *
 * ISO 3166-1 alpha-2: PY
 *
 * @link http://www.geonames.org/PY/administrative-division-paraguay.html
 */
class PySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Concepcion
        '10', // Alto Parana
        '11', // Central
        '12', // Neembucu
        '13', // Amambay
        '14', // Canindeyu
        '15', // Presidente Hayes
        '16', // Alto Paraguay
        '19', // Boqueron
        '2', // San Pedro
        '3', // Cordillera
        '4', // Guaira
        '5', // Caaguazu
        '6', // Caazapa
        '7', // Itapua
        '8', // Misiones
        '9', // Paraguari
        'ASU', // Asuncion
    ];

    public $compareIdentical = true;
}
