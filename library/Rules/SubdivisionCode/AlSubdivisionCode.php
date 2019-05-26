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
 * Validator for Albania subdivision code.
 *
 * ISO 3166-1 alpha-2: AL
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Berat
        '02', // Durrës
        '03', // Elbasan
        '04', // Fier
        '05', // Gjirokastër
        '06', // Korçë
        '07', // Kukës
        '08', // Lezhë
        '09', // Dibër
        '10', // Shkodër
        '11', // Tiranë
        '12', // Vlorë
        'BR', // Berat
        'BU', // Bulqizë
        'DI', // Dibër
        'DL', // Delvinë
        'DR', // Durrës
        'DV', // Devoll
        'EL', // Elbasan
        'ER', // Kolonjë
        'FR', // Fier
        'GJ', // Gjirokastër
        'GR', // Gramsh
        'HA', // Has
        'KA', // Kavajë
        'KB', // Kurbin
        'KC', // Kuçovë
        'KO', // Korçë
        'KR', // Krujë
        'KU', // Kukës
        'LB', // Librazhd
        'LE', // Lezhë
        'LU', // Lushnjë
        'MK', // Mallakastër
        'MM', // Malësi e Madhe
        'MR', // Mirditë
        'MT', // Mat
        'PG', // Pogradec
        'PQ', // Peqin
        'PR', // Përmet
        'PU', // Pukë
        'SH', // Shkodër
        'SK', // Skrapar
        'SR', // Sarandë
        'TE', // Tepelenë
        'TP', // Tropojë
        'TR', // Tiranë
        'VL', // Vlorë
    ];

    public $compareIdentical = true;
}
