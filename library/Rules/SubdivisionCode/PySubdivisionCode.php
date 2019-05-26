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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Concepción
        '10', // Alto Paraná
        '11', // Central
        '12', // Ñeembucú
        '13', // Amambay
        '14', // Canindeyú
        '15', // Presidente Hayes
        '16', // Alto Paraguay
        '19', // Boquerón
        '2', // San Pedro
        '3', // Cordillera
        '4', // Guairá
        '5', // Caaguazú
        '6', // Caazapá
        '7', // Itapúa
        '8', // Misiones
        '9', // Paraguarí
        'ASU', // Asunción
    ];

    public $compareIdentical = true;
}
