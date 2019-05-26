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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '1', // Bocas del Toro
        '2', // Coclé
        '3', // Colón
        '4', // Chiriquí
        '5', // Darién
        '6', // Herrera
        '7', // Los Santos
        '8', // Panamá
        '9', // Veraguas
        'EM', // Emberá
        'KY', // Kuna Yala
        'NB', // Ngöbe-Buglé
    ];

    public $compareIdentical = true;
}
