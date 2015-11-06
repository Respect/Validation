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
 * @link http://www.geonames.org/AE/administrative-division-united-arab-emirates.html
 */
class AeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AJ', // 'Ajman
        'AZ', // Abu Zaby
        'DU', // Dubayy
        'FU', // Al Fujayrah
        'RK', // R'as al Khaymah
        'SH', // Ash Shariqah
        'UQ', // Umm al Qaywayn
    ];

    public $compareIdentical = true;
}
