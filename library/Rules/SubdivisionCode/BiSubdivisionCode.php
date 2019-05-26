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
 * Validator for Burundi subdivision code.
 *
 * ISO 3166-1 alpha-2: BI
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BB', // Bubanza
        'BL', // Bujumbura Rural
        'BM', // Bujumbura Mairie
        'BR', // Bururi
        'CA', // Cankuzo
        'CI', // Cibitoke
        'GI', // Gitega
        'KI', // Kirundo
        'KR', // Karuzi
        'KY', // Kayanza
        'MA', // Makamba
        'MU', // Muramvya
        'MW', // Mwaro
        'NG', // Ngozi
        'RT', // Rutana
        'RY', // Ruyigi
    ];

    public $compareIdentical = true;
}
