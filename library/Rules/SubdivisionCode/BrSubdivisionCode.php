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
 * Validator for Brazil subdivision code.
 *
 * ISO 3166-1 alpha-2: BR
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AC', // Acre
        'AL', // Alagoas
        'AM', // Amazonas
        'AP', // Amapá
        'BA', // Bahia
        'CE', // Ceará
        'DF', // Distrito Federal
        'ES', // Espírito Santo
        'FN', // Fernando de Noronha
        'GO', // Goiás
        'MA', // Maranhão
        'MG', // Minas Gerais
        'MS', // Mato Grosso do Sul
        'MT', // Mato Grosso
        'PA', // Pará
        'PB', // Paraíba
        'PE', // Pernambuco
        'PI', // Piauí
        'PR', // Paraná
        'RJ', // Rio de Janeiro
        'RN', // Rio Grande do Norte
        'RO', // Rondônia
        'RR', // Roraima
        'RS', // Rio Grande do Sul
        'SC', // Santa Catarina
        'SE', // Sergipe
        'SP', // São Paulo
        'TO', // Tocantins
    ];

    public $compareIdentical = true;
}
