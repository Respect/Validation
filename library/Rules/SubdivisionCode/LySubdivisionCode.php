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
 * Validator for Libya subdivision code.
 *
 * ISO 3166-1 alpha-2: LY
 *
 * @link http://www.geonames.org/LY/administrative-division-libya.html
 */
class LySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Banghazi
        'BU', // Al Buţnān
        'DR', // Darnah
        'GT', // Ghāt
        'JA', // Al Jabal al Akhdar
        'JG', // Al Jabal al Gharbī
        'JI', // Al Jifārah
        'JU', // Al Jufrah
        'KF', // Al Kufrah
        'MB', // Al Marqab
        'MI', // Misratah
        'MJ', // Al Maraj
        'MQ', // Murzuq
        'NL', // Nālūt
        'NQ', // An Nuqat al Khams
        'SB', // Sabha
        'SR', // Surt
        'TB', // Ţarābulus
        'WA', // Al Wāḩāt
        'WD', // Wādī al Ḩayāt
        'WS', // Wādī ash Shāţi´
        'ZA', // Az Zawiyah
    ];

    public $compareIdentical = true;
}
