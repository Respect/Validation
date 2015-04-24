<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guinea country subdivision.
 *
 * ISO 3166-1 alpha-2: GN
 *
 * @link http://www.geonames.org/GN/administrative-division-guinea.html
 */
class GnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'B', // Boké
        'C', // Conakry
        'D', // Kindia
        'F', // Faranah
        'K', // Kankan
        'L', // Labé
        'M', // Mamou
        'N', // Nzérékoré
        'BE', // Beyla
        'BF', // Boffa
        'BK', // Boke
        'CO', // Coyah
        'DB', // Dabola
        'DI', // Dinguiraye
        'DL', // Dalaba
        'DU', // Dubreka
        'FA', // Faranah
        'FO', // Forecariah
        'FR', // Fria
        'GA', // Gaoual
        'GU', // Gueckedou
        'KA', // Kankan
        'KB', // Koubia
        'KD', // Kindia
        'KE', // Kerouane
        'KN', // Koundara
        'KO', // Kouroussa
        'KS', // Kissidougou
        'LA', // Labe
        'LE', // Lelouma
        'LO', // Lola
        'MC', // Macenta
        'MD', // Mandiana
        'ML', // Mali
        'MM', // Mamou
        'NZ', // Nzerekore
        'PI', // Pita
        'SI', // Siguiri
        'TE', // Telimele
        'TO', // Tougue
        'YO', // Yomou
    );

    public $compareIdentical = true;
}
