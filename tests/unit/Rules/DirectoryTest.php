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
use stdClass;

use function dir;

#[Group('rule')]
#[CoversClass(Directory::class)]
final class DirectoryTest extends RuleTestCase
{
    /**
     * @return array<array{Directory, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Directory();

        return [
            [$rule, __DIR__],
            [$rule, new SplFileInfo(__DIR__)],
            [$rule, dir(__DIR__)],
        ];
    }

    /**
     * @return array<array{Directory, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Directory();

        return [
            [$rule, new SplFileInfo(__FILE__)],
            [$rule, new SplFileObject(__FILE__)],
            [$rule, ''],
            [$rule, __FILE__],
            [$rule, new stdClass()],
            [$rule, [__DIR__]],
        ];
    }
}
