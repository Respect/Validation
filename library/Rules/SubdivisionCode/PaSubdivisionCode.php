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
 * Validator for Panama subdivision code.
 *
 * ISO 3166-1 alpha-2: PA
 *
 * @link http://www.geonames.org/PA/administrative-division-panama.html
 */
class PaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Bocas del Toro
        '2', // Cocle
        '3', // Colon
        '4', // Chiriqui
        '5', // Darien
        '6', // Herrera
        '7', // Los Santos
        '8', // Panama
        '9', // Veraguas
        'EM', // Comarca Emberá-Wounaan
        'KY', // Comarca de Kuna Yala
        'NB', // Ngöbe-Buglé
    ];

    public $compareIdentical = true;
}
