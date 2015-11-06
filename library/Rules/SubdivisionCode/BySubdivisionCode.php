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
 * Validator for Belarus subdivision code.
 *
 * ISO 3166-1 alpha-2: BY
 *
 * @link http://www.geonames.org/BY/administrative-division-belarus.html
 */
class BySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BR', // Brest voblast
        'HM', // Horad Minsk
        'HO', // Homyel voblast
        'HR', // Hrodna voblast
        'MA', // Mahilyow voblast
        'MI', // Minsk voblast
        'VI', // Vitsebsk voblast
    ];

    public $compareIdentical = true;
}
