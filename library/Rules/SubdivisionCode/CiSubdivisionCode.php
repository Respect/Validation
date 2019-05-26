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
 * Validator for Ivory Coast subdivision code.
 *
 * ISO 3166-1 alpha-2: CI
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Lagunes (Région des)
        '02', // Haut-Sassandra (Région du)
        '03', // Savanes (Région des)
        '04', // Vallée du Bandama (Région de la)
        '05', // Moyen-Comoé (Région du)
        '06', // 18 Montagnes (Région des)
        '07', // Lacs (Région des)
        '08', // Zanzan (Région du)
        '09', // Bas-Sassandra (Région du)
        '10', // Denguélé (Région du)
        '11', // Nzi-Comoé (Région)
        '12', // Marahoué (Région de la)
        '13', // Sud-Comoé (Région du)
        '14', // Worodouqou (Région du)
        '15', // Sud-Bandama (Région du)
        '16', // Agnébi (Région de l')
        '17', // Bafing (Région du)
        '18', // Fromager (Région du)
        '19', // Moyen-Cavally (Région du)
    ];

    public $compareIdentical = true;
}
