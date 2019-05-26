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
 * Validator for United Arab Emirates subdivision code.
 *
 * ISO 3166-1 alpha-2: AE
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AJ', // 'Ajmān
        'AZ', // Abū Ȥaby [Abu Dhabi]
        'DU', // Dubayy
        'FU', // Al Fujayrah
        'RK', // Ra’s al Khaymah
        'SH', // Ash Shāriqah
        'UQ', // Umm al Qaywayn
    ];

    public $compareIdentical = true;
}
