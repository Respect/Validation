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
 * Validator for North Korea subdivision code.
 *
 * ISO 3166-1 alpha-2: KP
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KpSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // P’yŏngyang
        '02', // P’yŏngan-namdo
        '03', // P’yŏngan-bukto
        '04', // Chagang-do
        '05', // Hwanghae-namdo
        '06', // Hwanghae-bukto
        '07', // Kangwŏn-do
        '08', // Hamgyŏng-namdo
        '09', // Hamgyŏng-bukto
        '10', // Yanggang-do
        '13', // Nasŏn (Najin-Sŏnbong)
    ];

    public $compareIdentical = true;
}
