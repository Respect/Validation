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
 * Validator for Ukraine subdivision code.
 *
 * ISO 3166-1 alpha-2: UA
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class UaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '05', // Vinnyts'ka Oblast'
        '07', // Volyns'ka Oblast'
        '09', // Luhans'ka Oblast'
        '12', // Dnipropetrovs'ka Oblast'
        '14', // Donets'ka Oblast'
        '18', // Zhytomyrs'ka Oblast'
        '21', // Zakarpats'ka Oblast'
        '23', // Zaporiz'ka Oblast'
        '26', // Ivano-Frankivs'ka Oblast'
        '30', // Kyïvs'ka mis'ka rada
        '32', // Kyïvs'ka Oblast'
        '35', // Kirovohrads'ka Oblast'
        '40', // Sevastopol
        '43', // Respublika Krym
        '46', // L'vivs'ka Oblast'
        '48', // Mykolaïvs'ka Oblast'
        '51', // Odes'ka Oblast'
        '53', // Poltavs'ka Oblast'
        '56', // Rivnens'ka Oblast'
        '59', // Sums 'ka Oblast'
        '61', // Ternopil's'ka Oblast'
        '63', // Kharkivs'ka Oblast'
        '65', // Khersons'ka Oblast'
        '68', // Khmel'nyts'ka Oblast'
        '71', // Cherkas'ka Oblast'
        '74', // Chernihivs'ka Oblast'
        '77', // Chernivets'ka Oblast'
    ];

    public $compareIdentical = true;
}
