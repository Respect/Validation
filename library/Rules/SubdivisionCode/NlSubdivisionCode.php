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
 * Validator for Netherlands subdivision code.
 *
 * ISO 3166-1 alpha-2: NL
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class NlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AW', // Aruba
        'BQ1', // Bonaire
        'BQ2', // Saba
        'BQ3', // Sint Eustatius
        'CW', // Curaçao
        'DR', // Drenthe
        'FL', // Flevoland
        'FR', // Friesland
        'GE', // Gelderland
        'GR', // Groningen
        'LI', // Limburg
        'NB', // Noord-Brabant
        'NH', // Noord-Holland
        'OV', // Overijssel
        'SX', // Sint Maarten
        'UT', // Utrecht
        'ZE', // Zeeland
        'ZH', // Zuid-Holland
    ];

    public $compareIdentical = true;
}
