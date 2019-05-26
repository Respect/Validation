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
 * Validator for Hong Kong subdivision code.
 *
 * ISO 3166-1 alpha-2: HK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class HkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'HCW', // Central and Western Hong Kong Island
        'HEA', // Eastern Hong Kong Island
        'HSO', // Southern Hong Kong Island
        'HWC', // Wan Chai Hong Kong Island
        'KKC', // Kowloon City Kowloon
        'KKT', // Kwun Tong Kowloon
        'KSS', // Sham Shui Po Kowloon
        'KWT', // Wong Tai Sin Kowloon
        'KYT', // Yau Tsim Mong Kowloon
        'NIS', // Islands New Territories
        'NKT', // Kwai Tsing New Territories
        'NNO', // North New Territories
        'NSK', // Sai Kung New Territories
        'NST', // Sha Tin New Territories
        'NTM', // Tuen Mun New Territories
        'NTP', // Tai Po New Territories
        'NTW', // Tsuen Wan New Territories
        'NYL', // Yuen Long New Territories
    ];

    public $compareIdentical = true;
}
