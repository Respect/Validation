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
 * Validator for Guinea subdivision code.
 *
 * ISO 3166-1 alpha-2: GN
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Boké
        'BE', // Beyla
        'BF', // Boffa
        'BK', // Boké
        'C', // Conakry
        'CO', // Coyah
        'D', // Kindia
        'DB', // Dabola
        'DI', // Dinguiraye
        'DL', // Dalaba
        'DU', // Dubréka
        'F', // Faranah
        'FA', // Faranah
        'FO', // Forécariah
        'FR', // Fria
        'GA', // Gaoual
        'GU', // Guékédou
        'K', // Kankan
        'KA', // Kankan
        'KB', // Koubia
        'KD', // Kindia
        'KE', // Kérouané
        'KN', // Koundara
        'KO', // Kouroussa
        'KS', // Kissidougou
        'L', // Labé
        'LA', // Labé
        'LE', // Lélouma
        'LO', // Lola
        'M', // Mamou
        'MC', // Macenta
        'MD', // Mandiana
        'ML', // Mali
        'MM', // Mamou
        'N', // Nzérékoré
        'NZ', // Nzérékoré
        'PI', // Pita
        'SI', // Siguiri
        'TE', // Télimélé
        'TO', // Tougué
        'YO', // Yomou
    ];

    public $compareIdentical = true;
}
