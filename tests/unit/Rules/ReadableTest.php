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

#[Group('validator')]
#[CoversClass(Readable::class)]
final class ReadableTest extends RuleTestCase
{
    /** @return iterable<array{Readable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $file = self::fixture('valid-image.gif');
        $validator = new Readable();

        return [
            [$validator, $file],
            [$validator, new SplFileInfo($file)],
            [$validator, StreamStub::create()],
        ];
    }

    /** @return iterable<array{Readable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $file = self::fixture('invalid-image.gif');
        $validator = new Readable();

        return [
            [$validator, $file],
            [$validator, new SplFileInfo($file)],
            [$validator, new stdClass()],
            [$validator, StreamStub::createUnreadable()],
        ];
    }
}
