<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
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

use function dir;

#[Group('validator')]
#[CoversClass(Directory::class)]
final class DirectoryTest extends RuleTestCase
{
    /** @return iterable<array{Directory, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Directory();

        return [
            [$validator, __DIR__],
            [$validator, new SplFileInfo(__DIR__)],
            [$validator, dir(__DIR__)],
        ];
    }

    /** @return iterable<array{Directory, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Directory();

        return [
            [$validator, new SplFileInfo(__FILE__)],
            [$validator, new SplFileObject(__FILE__)],
            [$validator, ''],
            [$validator, __FILE__],
            [$validator, new stdClass()],
            [$validator, [__DIR__]],
        ];
    }
}
