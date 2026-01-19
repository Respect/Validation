<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Gus Antoniassi <gus.antoniassi@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Royall Spence <royall@royall.us>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

use function tmpfile;

#[Group('validator')]
#[CoversClass(SymbolicLink::class)]
final class SymbolicLinkTest extends RuleTestCase
{
    /** @return iterable<array{SymbolicLink, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new SymbolicLink();

        return [
            'filename' => [$sut, 'tests/fixtures/symbolic-link'],
            'SplFileInfo' => [$sut, new SplFileInfo('tests/fixtures/symbolic-link')],
            'SplFileObject' => [$sut, new SplFileObject('tests/fixtures/symbolic-link')],
        ];
    }

    /** @return iterable<array{SymbolicLink, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new SymbolicLink();

        return [
            'no existing filename' => [$sut, 'tests/fixtures/non-existing-symbolic-link'],
            'no existing SplFileInfo' => [$sut, new SplFileInfo('tests/fixtures/non-existing-symbolic-link')],
            'bool true' => [$sut, true],
            'bool false' => [$sut, false],
            'empty string' => [$sut, ''],
            'array' => [$sut, []],
            'resource' => [$sut, tmpfile()],
        ];
    }
}
