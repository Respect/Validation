<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Monaco country subdivision.
 *
 * ISO 3166-1 alpha-2: MC
 *
 * @link http://www.geonames.org/MC/administrative-division-monaco.html
 */
class McCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CL', // La Colle
        'CO', // La Condamine
        'FO', // Fontvieille
        'GA', // La Gare
        'JE', // Jardin Exotique
        'LA', // Larvotto
        'MA', // Malbousquet
        'MC', // Monte-Carlo
        'MG', // Moneghetti
        'MO', // Monaco-Ville
        'MU', // Moulins
        'PH', // Port-Hercule
        'SD', // Sainte-Dévote
        'SO', // La Source
        'SP', // Spélugues
        'SR', // Saint-Roman
        'VR', // Vallon de la Rousse
    );

    public $compareIdentical = true;
}
