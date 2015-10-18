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
 * Validator for Bhutan subdivision code.
 *
 * ISO 3166-1 alpha-2: BT
 *
 * @link http://www.geonames.org/BT/administrative-division-bhutan.html
 */
class BtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '11', // Paro
        '12', // Chukha
        '13', // Haa
        '14', // Samtse
        '15', // Thimphu
        '21', // Tsirang
        '22', // Dagana
        '23', // Punakha
        '24', // Wangdue Phodrang
        '31', // Sarpang
        '32', // Trongsa
        '33', // Bumthang
        '34', // Zhemgang
        '41', // Trashigang
        '42', // Mongar
        '43', // Pemagatshel
        '44', // Lhuntse
        '45', // Samdrup Jongkhar
        'GA', // Gasa
        'TY', // Trashi Yangste
    ];

    public $compareIdentical = true;
}
