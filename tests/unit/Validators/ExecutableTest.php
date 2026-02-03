<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;
use stdClass;

#[Group('validator')]
#[CoversClass(Executable::class)]
final class ExecutableTest extends RuleTestCase
{
    /** @return iterable<array{Executable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Executable();

        return [
            [$validator, 'tests/fixtures/executable'],
            [$validator, new SplFileInfo('tests/fixtures/executable')],
            [$validator, new SplFileObject('tests/fixtures/executable')],
        ];
    }

    /** @return iterable<array{Executable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Executable();

        return [
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, 'tests/fixtures/valid-image.gif'],
            [$validator, new SplFileInfo('tests/fixtures/valid-image.jpg')],
            [$validator, new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }
}
