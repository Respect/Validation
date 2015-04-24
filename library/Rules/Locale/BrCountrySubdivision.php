<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Brazil country subdivision.
 *
 * ISO 3166-1 alpha-2: BR
 *
 * @link http://www.geonames.org/BR/administrative-division-brazil.html
 */
class BrCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}
