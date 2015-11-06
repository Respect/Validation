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
 * @link http://www.geonames.org/CH/administrative-division-switzerland.html
 */
class ChSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AG', // Aargau
        'AI', // Appenzell Innerhoden
        'AR', // Appenzell Ausserrhoden
        'BE', // Bern
        'BL', // Basel-Landschaft
        'BS', // Basel-Stadt
        'FR', // Fribourg
        'GE', // Geneva
        'GL', // Glarus
        'GR', // Graubunden
        'JU', // Jura
        'LU', // Lucerne
        'NE', // Neuchâtel
        'NW', // Nidwalden
        'OW', // Obwalden
        'SG', // St. Gallen
        'SH', // Schaffhausen
        'SO', // Solothurn
        'SZ', // Schwyz
        'TG', // Thurgau
        'TI', // Ticino
        'UR', // Uri
        'VD', // Vaud
        'VS', // Valais
        'ZG', // Zug
        'ZH', // Zurich
    ];

    public $compareIdentical = true;
}
