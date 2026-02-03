<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\ToStringStub;
use stdClass;

use function tmpfile;

#[Group('validator')]
#[CoversClass(StringVal::class)]
final class StringValTest extends RuleTestCase
{
    /** @return iterable<array{StringVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new StringVal();

        return [
            [$validator, '6'],
            [$validator, 'String'],
            [$validator, 1.0],
            [$validator, 42],
            [$validator, false],
            [$validator, true],
            [$validator, new ToStringStub('something')],
        ];
    }

    /** @return iterable<array{StringVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new StringVal();

        return [
            [$validator, []],
            [
                $validator,
                static function (): void {
                },
            ],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, tmpfile()],
        ];
    }
}
