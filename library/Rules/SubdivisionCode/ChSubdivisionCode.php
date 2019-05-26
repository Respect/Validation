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
 * Validator for Switzerland subdivision code.
 *
 * ISO 3166-1 alpha-2: CH
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ChSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AG', // Aargau
        'AI', // Appenzell Innerrhoden
        'AR', // Appenzell Ausserrhoden
        'BE', // Bern
        'BL', // Basel-Landschaft
        'BS', // Basel-Stadt
        'FR', // Fribourg
        'GE', // Genève
        'GL', // Glarus
        'GR', // Graubünden
        'JU', // Jura
        'LU', // Luzern
        'NE', // Neuchâtel
        'NW', // Nidwalden
        'OW', // Obwalden
        'SG', // Sankt Gallen
        'SH', // Schaffhausen
        'SO', // Solothurn
        'SZ', // Schwyz
        'TG', // Thurgau
        'TI', // Ticino
        'UR', // Uri
        'VD', // Vaud
        'VS', // Valais
        'ZG', // Zug
        'ZH', // Zürich
    ];

    public $compareIdentical = true;
}
