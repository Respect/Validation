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
 * Validator for Belgium subdivision code.
 *
 * ISO 3166-1 alpha-2: BE
 *
 * @see http://www.geonames.org/BE/administrative-division-belgium.html
 */
class BeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BRU', // Brussels
        'VAN', // Antwerpen
        'VBR', // Vlaams Brabant
        'VLG', // Flanders
        'VLI', // Limburg
        'VOV', // Oost-Vlaanderen
        'VWV', // West-Vlaanderen
        'WAL', // Wallonia
        'WBR', // Brabant Wallon
        'WHT', // Hainaut
        'WLG', // Liege
        'WLX', // Luxembourg
        'WNA', // Namur
    ];

    public $compareIdentical = true;
}
