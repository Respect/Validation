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
 * @link http://www.geonames.org/AL/administrative-division-albania.html
 */
class AlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Berat
        '02', // Durres
        '03', // Elbasan
        '04', // Fier
        '05', // Gjirokaster
        '06', // Korce
        '07', // Kukes
        '08', // Lezhe
        '09', // Diber
        '10', // Shkoder
        '11', // Tirane
        '12', // Vlore
        'BR', // Berat
        'BU', // Bulqize
        'DI', // Diber
        'DL', // Delvine
        'DR', // Durres
        'DV', // Devoll
        'EL', // Elbasan
        'ER', // Kolonje
        'FR', // Fier
        'GJ', // Gjirokaster
        'GR', // Gramsh
        'HA', // Has
        'KA', // Kavaje
        'KB', // Kurbin
        'KC', // Kucove
        'KO', // Korce
        'KR', // Kruje
        'KU', // Kukes
        'LB', // Librazhd
        'LE', // Lezhe
        'LU', // Lushnje
        'MK', // Mallakaster
        'MM', // Malesi e Madhe
        'MR', // Mirdite
        'MT', // Mat
        'PG', // Pogradec
        'PQ', // Peqin
        'PR', // Permet
        'PU', // Puke
        'SH', // Shkoder
        'SK', // Skrapar
        'SR', // Sarande
        'TE', // Tepelene
        'TP', // Tropoje
        'TR', // Tirane
        'VL', // Vlore
    ];

    public $compareIdentical = true;
}
