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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class NiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Atlántico Norte
        'AS', // Atlántico Sur
        'BO', // Boaco
        'CA', // Carazo
        'CI', // Chinandega
        'CO', // Chontales
        'ES', // Estelí
        'GR', // Granada
        'JI', // Jinotega
        'LE', // León
        'MD', // Madriz
        'MN', // Managua
        'MS', // Masaya
        'MT', // Matagalpa
        'NS', // Nueva Segovia
        'RI', // Rivas
        'SJ', // Río San Juan
    ];

    public $compareIdentical = true;
}
