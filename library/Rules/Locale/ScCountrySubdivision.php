<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Seychelles country subdivision.
 *
 * ISO 3166-1 alpha-2: SC
 *
 * @link http://www.geonames.org/SC/administrative-division-seychelles.html
 */
class ScCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Anse aux Pins
        '02', // Anse Boileau
        '03', // Anse Etoile
        '04', // Anse Louis
        '05', // Anse Royale
        '06', // Baie Lazare
        '07', // Baie Sainte Anne
        '08', // Beau Vallon
        '09', // Bel Air
        '10', // Bel Ombre
        '11', // Cascade
        '12', // Glacis
        '13', // Grand' Anse (on Mahe)
        '14', // Grand' Anse (on Praslin)
        '15', // La Digue
        '16', // La Riviere Anglaise
        '17', // Mont Buxton
        '18', // Mont Fleuri
        '19', // Plaisance
        '20', // Pointe La Rue
        '21', // Port Glaud
        '22', // Saint Louis
        '23', // Takamaka
        '24', // Les Mamelles
        '25', // Roche Caïman
    );

    public $compareIdentical = true;
}
