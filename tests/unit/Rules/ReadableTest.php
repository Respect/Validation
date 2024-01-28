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
use Respect\Validation\Test\Stubs\StreamStub;
use SplFileInfo;
use stdClass;

#[Group('rule')]
#[CoversClass(Readable::class)]
final class ReadableTest extends RuleTestCase
{
    /**
     * @return array<array{Readable, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $file = self::fixture('valid-image.gif');
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, StreamStub::create()],
        ];
    }

    /**
     * @return array<array{Readable, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $file = self::fixture('invalid-image.gif');
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, new stdClass()],
            [$rule, StreamStub::createUnreadable()],
        ];
    }
}
