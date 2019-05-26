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
 * Validator for Armenia subdivision code.
 *
 * ISO 3166-1 alpha-2: AM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AG', // Aragacotn
        'AR', // Ararat
        'AV', // Armavir
        'ER', // Erevan
        'GR', // Gegarkunik'
        'KT', // Kotayk'
        'LO', // Lory
        'SH', // Sirak
        'SU', // Syunik'
        'TV', // Tavus
        'VD', // Vayoc Jor
    ];

    public $compareIdentical = true;
}
