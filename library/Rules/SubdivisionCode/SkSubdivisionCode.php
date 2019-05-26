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
 * Validator for Slovakia subdivision code.
 *
 * ISO 3166-1 alpha-2: SK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BC', // Banskobystrický kraj
        'BL', // Bratislavský kraj
        'KI', // Košický kraj
        'NI', // Nitriansky kraj
        'PV', // Prešovský kraj
        'TA', // Trnavský kraj
        'TC', // Trenčiansky kraj
        'ZI', // Žilinský kraj
    ];

    public $compareIdentical = true;
}
