<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function stream_context_create;

#[Group(' rule')]
#[CoversClass(Nif::class)]
final class NifTest extends RuleTestCase
{
    /** @return iterable<array{Nif, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Nif();

        return [
            // DNI
            [$validator, '71110316C'],
            [$validator, '99977944A'],
            [$validator, '70963442R'],
            [$validator, '49294492H'],
            [$validator, '11381116A'],

            // NIE
            [$validator, 'X0425894A'],
            [$validator, 'Y4819664M'],
            [$validator, 'Y7407711T'],
            [$validator, 'Y1168744J'],
            [$validator, 'Y1168744J'],

            // CIF
            [$validator, 'B56109770'],
            [$validator, 'V8002614I'],
            [$validator, 'R1332622H'],
            [$validator, 'Q6771656C'],
            [$validator, 'F3148958F'],
            [$validator, 'Q8703717B'],
        ];
    }

    /** @return iterable<array{Nif, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Nif();

        return [
            // DNI
            [$validator, '71110316c'],
            [$validator, '36822315D'],
            [$validator, '43901481F'],
            [$validator, '67931854U'],
            [$validator, '20890122T'],
            [$validator, '28799818A'],

            // NIE
            [$validator, 'x0425894a'],
            [$validator, 'Y3012039X'],
            [$validator, 'Z2448415H'],
            [$validator, 'Y7225582L'],
            [$validator, 'Y9613245P'],
            [$validator, 'X3155250B'],

            // CIF
            [$validator, 'B56109771'],
            [$validator, 'v8002614i'],
            [$validator, 'C0325664D'],
            [$validator, 'R27038239'],
            [$validator, 'P6437358A'],
            [$validator, 'W9188340B'],
            [$validator, 'E05172860'],

            // No regex match
            [$validator, ''],
            [$validator, 'I05172860'],
            [$validator, 'T2448415H'],

            // Weird types
            [$validator, []],
            [$validator, true],
            [$validator, 1],
            [$validator, 0.5],
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, stream_context_create()],
        ];
    }
}
