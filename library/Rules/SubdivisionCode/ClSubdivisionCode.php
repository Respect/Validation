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
 * Validator for Chile subdivision code.
 *
 * ISO 3166-1 alpha-2: CL
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ClSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AI', // Aisén del General Carlos Ibáñez del Campo
        'AN', // Antofagasta
        'AP', // Arica y Parinacota
        'AR', // Araucanía
        'AT', // Atacama
        'BI', // Bío-Bío
        'CO', // Coquimbo
        'LI', // Libertador General Bernardo O'Higgins
        'LL', // Los Lagos
        'LR', // Los Ríos
        'MA', // Magallanes y Antártica Chilena
        'ML', // Maule
        'RM', // Región Metropolitana de Santiago
        'TA', // Tarapacá
        'VS', // Valparaíso
    ];

    public $compareIdentical = true;
}
