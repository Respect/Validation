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
 * Validator for Nicaragua subdivision code.
 *
 * ISO 3166-1 alpha-2: NI
 *
 * @link http://www.geonames.org/NI/administrative-division-nicaragua.html
 */
class NiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Region Autonoma del Atlantico Norte
        'AS', // Region Autonoma del Atlantico Sur
        'BO', // Boaco
        'CA', // Carazo
        'CI', // Chinandega
        'CO', // Chontales
        'ES', // Esteli
        'GR', // Granada
        'JI', // Jinotega
        'LE', // Leon
        'MD', // Madriz
        'MN', // Managua
        'MS', // Masaya
        'MT', // Matagalpa
        'NS', // Nueva Segovia
        'RI', // Rivas
        'SJ', // Rio San Juan
    ];

    public $compareIdentical = true;
}
