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
 * Validator for Portugal subdivision code.
 *
 * ISO 3166-1 alpha-2: PT
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Aveiro
        '02', // Beja
        '03', // Braga
        '04', // Bragança
        '05', // Castelo Branco
        '06', // Coimbra
        '07', // Évora
        '08', // Faro
        '09', // Guarda
        '10', // Leiria
        '11', // Lisboa
        '12', // Portalegre
        '13', // Porto
        '14', // Santarém
        '15', // Setúbal
        '16', // Viana do Castelo
        '17', // Vila Real
        '18', // Viseu
        '20', // Região Autónoma dos Açores
        '30', // Região Autónoma da Madeira
    ];

    public $compareIdentical = true;
}
