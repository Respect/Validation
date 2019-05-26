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
 * Validator for Cape Verde subdivision code.
 *
 * ISO 3166-1 alpha-2: CV
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Ilhas de Barlavento
        'BR', // Brava
        'BV', // Boa Vista
        'CA', // Santa Catarina
        'CF', // Santa Catarina de Fogo
        'CR', // Santa Cruz
        'MA', // Maio
        'MO', // Mosteiros
        'PA', // Paul
        'PN', // Porto Novo
        'PR', // Praia
        'RB', // Ribeira Brava
        'RG', // Ribeira Grande
        'RS', // Ribeira Grande de Santiago
        'S', // Ilhas de Sotavento
        'SD', // São Domingos
        'SF', // São Filipe
        'SL', // Sal
        'SM', // São Miguel
        'SO', // São Lourenço dos Órgãos
        'SS', // São Salvador do Mundo
        'SV', // São Vicente
        'TA', // Tarrafal
        'TS', // Tarrafal de São Nicolau
    ];

    public $compareIdentical = true;
}
