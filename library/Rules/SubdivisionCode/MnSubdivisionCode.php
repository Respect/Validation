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
 * Validator for Mongolia subdivision code.
 *
 * ISO 3166-1 alpha-2: MN
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '035', // Orhon
        '037', // Darhan uul
        '039', // Hentiy
        '041', // Hövsgöl
        '043', // Hovd
        '046', // Uvs
        '047', // Töv
        '049', // Selenge
        '051', // Sühbaatar
        '053', // Ömnögovi
        '055', // Övörhangay
        '057', // Dzavhan
        '059', // Dundgovi
        '061', // Dornod
        '063', // Dornogovi
        '064', // Govi-Sumber
        '065', // Govi-Altay
        '067', // Bulgan
        '069', // Bayanhongor
        '071', // Bayan-Ölgiy
        '073', // Arhangay
        '1', // Ulanbaatar
    ];

    public $compareIdentical = true;
}
