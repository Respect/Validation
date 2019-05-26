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
 * Validator for Belgium subdivision code.
 *
 * ISO 3166-1 alpha-2: BE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BRU', // Bruxelles-Capitale, Région de;Brussels Hoofdstedelijk Gewest
        'VAN', // Antwerpen
        'VBR', // Vlaams-Brabant
        'VLG', // Vlaams Gewest
        'VLI', // Limburg
        'VOV', // Oost-Vlaanderen
        'VWV', // West-Vlaanderen
        'WAL', // wallonne, Région
        'WBR', // Brabant wallon
        'WHT', // Hainaut
        'WLG', // Liège
        'WLX', // Luxembourg
        'WNA', // Namur
    ];

    public $compareIdentical = true;
}
