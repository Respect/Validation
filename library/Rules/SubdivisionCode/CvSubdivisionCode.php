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
 * Validates whether an input is subdivision code of Cape Verde or not.
 *
 * ISO 3166-1 alpha-2: CV
 *
 * @see http://www.geonames.org/CV/administrative-division-cape-verde.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CvSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'B', // Ilhas de Barlavento
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
           'S', // Ilhas de Sotavento
           'SD', // Sao Domingos
           'SF', // Sao Filipe
           'SL', // Sal
           'SM', // São Miguel
           'SO', // São Lourenço dos Orgãos
           'SS', // São Salvador do Mundo
           'SV', // Sao Vicente
           'TA', // Tarrafal
           'TS', // Tarrafal de São Nicolau
       ];
    }
}
