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
 * @link http://www.geonames.org/CL/administrative-division-chile.html
 */
class ClSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AI', // Aisen del General Carlos Ibanez del Campo (XI)
        'AN', // Antofagasta (II)
        'AP', // Arica y Parinacota
        'AR', // Araucania (IX)
        'AT', // Atacama (III)
        'BI', // Bio-Bio (VIII)
        'CO', // Coquimbo (IV)
        'LI', // Libertador General Bernardo O'Higgins (VI)
        'LL', // Los Lagos (X)
        'LR', // Los Ríos
        'MA', // Magallanes (XII)
        'ML', // Maule (VII)
        'RM', // Region Metropolitana (RM)
        'TA', // Tarapaca (I)
        'VS', // Valparaiso (V)
    ];

    public $compareIdentical = true;
}
