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
 * Validator for Seychelles subdivision code.
 *
 * ISO 3166-1 alpha-2: SC
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ScSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
        '13', // Grand Anse Mahe
        '14', // Grand Anse Praslin
        '15', // La Digue
        '16', // English River
        '17', // Mont Buxton
        '18', // Mont Fleuri
        '19', // Plaisance
        '20', // Pointe Larue
        '21', // Port Glaud
        '22', // Saint Louis
        '23', // Takamaka
        '24', // Les Mamelles
        '25', // Roche Caiman
    ];

    public $compareIdentical = true;
}
