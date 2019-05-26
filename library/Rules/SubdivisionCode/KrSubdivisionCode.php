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
 * Validator for South Korea subdivision code.
 *
 * ISO 3166-1 alpha-2: KR
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '11', // Seoul Teugbyeolsi
        '26', // Busan Gwang'yeogsi
        '27', // Daegu Gwang'yeogsi
        '28', // Incheon Gwang'yeogsi
        '29', // Gwangju Gwang'yeogsi
        '30', // Daejeon Gwang'yeogsi
        '31', // Ulsan Gwang'yeogsi
        '41', // Gyeonggido
        '42', // Gang'weondo
        '43', // Chungcheongbukdo
        '44', // Chungcheongnamdo
        '45', // Jeonrabukdo
        '46', // Jeonranamdo
        '47', // Gyeongsangbukdo
        '48', // Gyeongsangnamdo
        '49', // Jejudo
    ];

    public $compareIdentical = true;
}
