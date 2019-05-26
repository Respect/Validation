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
 * Validator for Zimbabwe subdivision code.
 *
 * ISO 3166-1 alpha-2: ZW
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ZwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BU', // Bulawayo
        'HA', // Harare
        'MA', // Manicaland
        'MC', // Mashonaland Central
        'ME', // Mashonaland East
        'MI', // Midlands
        'MN', // Matabeleland North
        'MS', // Matabeleland South
        'MV', // Masvingo
        'MW', // Mashonaland West
    ];

    public $compareIdentical = true;
}
