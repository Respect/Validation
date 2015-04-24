<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cape Verde country subdivision.
 *
 * ISO 3166-1 alpha-2: CV
 *
 * @link http://www.geonames.org/CV/administrative-division-cape-verde.html
 */
class CvCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}
