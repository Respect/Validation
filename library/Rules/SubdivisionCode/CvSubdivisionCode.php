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
 * @link http://www.geonames.org/CV/administrative-division-cape-verde.html
 */
class CvSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Ilhas de Barlavento
        'S', // Ilhas de Sotavento
        'BR', // Brava
        'BV', // Boa Vista
        'CA', // Santa Catarina
        'CF', // Santa Catarina do Fogo
        'CR', // Santa Cruz
        'MA', // Maio
        'MO', // Mosteiros
        'PA', // Paul
        'PN', // Porto Novo
        'PR', // Praia
        'RB', // Ribeira Brava
        'RG', // Ribeira Grande
        'RS', // Ribeira Grande de Santiago
        'SD', // Sao Domingos
        'SF', // Sao Filipe
        'SL', // Sal
        'SL*', // São Lourenço dos Orgãos
        'SM', // São Miguel
        'SS', // São Salvador do Mundo
        'SV', // Sao Vicente
        'TA', // Tarrafal
        'TS', // Tarrafal de São Nicolau
    ];

    public $compareIdentical = true;
}
