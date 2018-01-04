<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Iraq subdivision code.
 *
 * ISO 3166-1 alpha-2: IQ
 *
 * @see http://www.geonames.org/IQ/administrative-division-iraq.html
 */
class IqSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Al Anbar
        'AR', // Arbīl
        'BA', // Al Basrah
        'BB', // Babil
        'BG', // Baghdad
        'DA', // Dahūk
        'DI', // Diyala
        'DQ', // Dhi Qar
        'KA', // Al Karbala
        'KI', // Kirkūk
        'MA', // Maysan
        'MU', // Al Muthanna
        'NA', // An Najaf
        'NI', // Ninawa
        'QA', // Al Qadisyah
        'SD', // Salah ad Din
        'SU', // As Sulaymānīyah
        'WA', // Wasit
    ];

    public $compareIdentical = true;
}
