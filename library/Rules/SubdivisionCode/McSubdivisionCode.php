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
 * Validator for Monaco subdivision code.
 *
 * ISO 3166-1 alpha-2: MC
 *
 * @link http://www.geonames.org/MC/administrative-division-monaco.html
 */
class McSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
    ];

    public $compareIdentical = true;
}
