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
 * Validator for Estonia subdivision code.
 *
 * ISO 3166-1 alpha-2: EE
 *
 * @link http://www.geonames.org/EE/administrative-division-estonia.html
 */
class EeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '37', // Harju County
        '39', // Hiiu County
        '44', // Ida-Viru County
        '49', // Jõgeva County
        '51', // Järva County
        '57', // Lääne County
        '59', // Lääne-Viru County
        '65', // Põlva County
        '67', // Pärnu County
        '70', // Rapla County
        '74', // Saare County
        '78', // Tartu County
        '82', // Valga County
        '84', // Viljandi County
        '86', // Võru County
    ];

    public $compareIdentical = true;
}
