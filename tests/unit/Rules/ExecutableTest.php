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
use SplFileInfo;
use SplFileObject;

#[Group('rule')]
#[CoversClass(Executable::class)]
final class ExecutableTest extends RuleTestCase
{
    /**
     * @return array<array{Executable, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Executable();

        return [
            [$rule, 'tests/fixtures/executable'],
            [$rule, new SplFileInfo('tests/fixtures/executable')],
            [$rule, new SplFileObject('tests/fixtures/executable')],
        ];
    }

    /**
     * @return array<array{Executable, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Executable();

        return [
            [$rule, 'tests/fixtures/valid-image.gif'],
            [$rule, new SplFileInfo('tests/fixtures/valid-image.jpg')],
            [$rule, new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }
}
