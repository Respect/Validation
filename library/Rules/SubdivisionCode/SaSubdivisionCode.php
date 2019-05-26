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
 * Validator for Saudi Arabia subdivision code.
 *
 * ISO 3166-1 alpha-2: SA
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class SaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Ar Riyāḍ
        '02', // Makkah
        '03', // Al Madīnah
        '04', // Ash Sharqīyah
        '05', // Al Qaşīm
        '06', // Ḥā'il
        '07', // Tabūk
        '08', // Al Ḥudūd ash Shamāliyah
        '09', // Jīzan
        '10', // Najrān
        '11', // Al Bāhah
        '12', // Al Jawf
        '14', // `Asīr
    ];

    public $compareIdentical = true;
}
