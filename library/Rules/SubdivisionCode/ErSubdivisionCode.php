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
 * Validator for Eritrea subdivision code.
 *
 * ISO 3166-1 alpha-2: ER
 *
 * @link http://www.geonames.org/ER/administrative-division-eritrea.html
 */
class ErSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Anseba (Keren)
        'DK', // Southern Red Sea (Debub-Keih-Bahri)
        'DU', // Southern (Debub)
        'GB', // Gash-Barka (Barentu)
        'MA', // Central (Maekel)
        'SK', // Northern Red Sea (Semien-Keih-Bahri)
    ];

    public $compareIdentical = true;
}
