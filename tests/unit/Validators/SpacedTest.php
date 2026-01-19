<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Augusto Pascutti <augusto.hp@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Spaced::class)]
final class SpacedTest extends RuleTestCase
{
    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Spaced();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 0],
            [$validator, 'wpoiur'],
            [$validator, 'Foo'],
            [$validator, []],
            [$validator, new stdClass()],
        ];
    }

    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Spaced();

        return [
            [$validator, ' '],
            [$validator, 'w poiur'],
            [$validator, '      '],
            [$validator, "Foo\nBar"],
            [$validator, "Foo\tBar"],
        ];
    }
}
