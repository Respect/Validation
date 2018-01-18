<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Brazil or not.
 *
 * ISO 3166-1 alpha-2: BR
 *
 * @see http://www.geonames.org/BR/administrative-division-brazil.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BrSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AC', // Acre
           'AL', // Alagoas
           'AM', // Amazonas
           'AP', // Amapa
           'BA', // Bahia
           'CE', // Ceara
           'DF', // Distrito Federal
           'ES', // Espirito Santo
           'GO', // Goias
           'MA', // Maranhao
           'MG', // Minas Gerais
           'MS', // Mato Grosso do Sul
           'MT', // Mato Grosso
           'PA', // Para
           'PB', // Paraiba
           'PE', // Pernambuco
           'PI', // Piaui
           'PR', // Parana
           'RJ', // Rio de Janeiro
           'RN', // Rio Grande do Norte
           'RO', // Rondonia
           'RR', // Roraima
           'RS', // Rio Grande do Sul
           'SC', // Santa Catarina
           'SE', // Sergipe
           'SP', // Sao Paulo
           'TO', // Tocantins
       ];
    }
}
