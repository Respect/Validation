<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Gabriel Pedro
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kinn Coelho Julião <kinncj@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pascal Borreli <pascal@borreli.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function str_repeat;

#[Group('validator')]
#[CoversClass(Cnh::class)]
final class CnhTest extends RuleTestCase
{
    /** @return iterable<array{Cnh, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Cnh();

        return [
            [$validator, '02650306461'],
            [$validator, '04397322870'],
            [$validator, '04375701302'],
            [$validator, '02996843266'],
            [$validator, '04375700501'],
            [$validator, '02605113410'],
            [$validator, '03247061306'],
            [$validator, '01258750259'],
            [$validator, '00739751580'],
            [$validator, '03375637504'],
            [$validator, '02542551342'],
            [$validator, '01708111400'],
            [$validator, '00836510948'],
            [$validator, '04365445978'],
            [$validator, '04324384302'],
            [$validator, '04339482949'],
            [$validator, '01036520050'],
            [$validator, '01612581027'],
            [$validator, '00603454740'],
            [$validator, '04129251992'],
            [$validator, '03401740201'],
            [$validator, '03417248301'],
            [$validator, '00670431345'],
            [$validator, '03292694405'],
        ];
    }

    /** @return iterable<array{Cnh, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Cnh();

        return [
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, '0265131640'],
            [$validator, '0439732280'],
            [$validator, '0437571130'],
            [$validator, '0299684320'],
            [$validator, '0437571150'],
            [$validator, '0261511340'],
            [$validator, '0324716130'],
            [$validator, '0125875120'],
            [$validator, '0173975150'],
            [$validator, '0337563750'],
            [$validator, '0254255130'],
            [$validator, '0171811140'],
            [$validator, '0183651190'],
            [$validator, '0436544590'],
            [$validator, '0432438430'],
            [$validator, '0433948290'],
            [$validator, '0113652110'],
            [$validator, '0161258110'],
            [$validator, '0161345470'],
            [$validator, '0412925190'],
            [$validator, '0341174120'],
            [$validator, '0341724830'],
            [$validator, '0167143130'],
            [$validator, '0329269440'],
            [$validator, ''],
            [$validator, 'F265F3F6461'],
            [$validator, 'F439732287F'],
            [$validator, 'F43757F13F2'],
            [$validator, 'F2996843266'],
            [$validator, 'F43757FF5F1'],
            [$validator, 'F26F511341F'],
            [$validator, 'F3247F613F6'],
            [$validator, 'F125875F259'],
            [$validator, 'FF73975158F'],
            [$validator, 'F33756375F4'],
            [$validator, 'F2542551342'],
            [$validator, 'F17F81114FF'],
            [$validator, 'FF83651F948'],
            [$validator, 'F4365445978'],
            [$validator, 'F43243843F2'],
            [$validator, 'F4339482949'],
            [$validator, 'F1F3652FF5F'],
            [$validator, 'F1612581F27'],
            [$validator, 'FF6F345474F'],
            [$validator, 'F4129251992'],
            [$validator, 'F34F174F2F1'],
            [$validator, 'F34172483F1'],
            [$validator, 'FF67F431345'],
            [$validator, 'F32926944F5'],
            [$validator, '00265003006461'],
            [$validator, '0043973228700'],
            [$validator, '00437570013002'],
            [$validator, '002996843266'],
            [$validator, '004375700005001'],
            [$validator, '00260051134100'],
            [$validator, '00324700613006'],
            [$validator, '0012587500259'],
            [$validator, '00007397515800'],
            [$validator, '0033756375004'],
            [$validator, '002542551342'],
            [$validator, '001700811140000'],
            [$validator, '00008365100948'],
            [$validator, '004365445978'],
            [$validator, '0043243843002'],
            [$validator, '004339482949'],
            [$validator, '0010036520000500'],
            [$validator, '0016125810027'],
            [$validator, '000060034547400'],
            [$validator, '004129251992'],
            [$validator, '003400174002001'],
            [$validator, '0034172483001'],
            [$validator, '00006700431345'],
            [$validator, '0032926944005'],
            [$validator, str_repeat('0', 11)],
            [$validator, str_repeat('1', 11)],
            [$validator, str_repeat('2', 11)],
            [$validator, str_repeat('3', 11)],
            [$validator, str_repeat('4', 11)],
            [$validator, str_repeat('5', 11)],
            [$validator, str_repeat('6', 11)],
            [$validator, str_repeat('7', 11)],
            [$validator, str_repeat('8', 11)],
            [$validator, str_repeat('9', 11)],
        ];
    }
}
