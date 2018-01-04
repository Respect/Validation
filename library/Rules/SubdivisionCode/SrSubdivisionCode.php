<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Suriname subdivision code.
 *
 * ISO 3166-1 alpha-2: SR
 *
 * @see http://www.geonames.org/SR/administrative-division-suriname.html
 */
class SrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BR', // Brokopondo
        'CM', // Commewijne
        'CR', // Coronie
        'MA', // Marowijne
        'NI', // Nickerie
        'PM', // Paramaribo
        'PR', // Para
        'SA', // Saramacca
        'SI', // Sipaliwini
        'WA', // Wanica
    ];

    public $compareIdentical = true;
}
