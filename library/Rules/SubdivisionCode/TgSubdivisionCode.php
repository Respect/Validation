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
 * Validator for Togo subdivision code.
 *
 * ISO 3166-1 alpha-2: TG
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class TgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'C', // Région du Centre
        'K', // Région de la Kara
        'M', // Région Maritime
        'P', // Région des Plateaux
        'S', // Région des Savannes
    ];

    public $compareIdentical = true;
}
