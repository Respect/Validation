<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(All::class)]
final class AllTest extends TestCase
{
    /** @return iterable<string, array{Stub, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'all pass with array' => [Stub::pass(3), [1, 2, 3]];
        yield 'all pass with ArrayObject' => [Stub::pass(3), new ArrayObject([1, 2, 3])];
        yield 'single element that passes' => [Stub::pass(1), ['value']];
        yield 'all pass with array of strings' => [Stub::pass(5), ['a', 'b', 'c', 'd', 'e']];
    }

    /** @return iterable<string, array{Stub, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'some fail with array' => [Stub::fail(3), [1, 2, 3]];
        yield 'all fail with array' => [Stub::fail(3), [1, 2, 3]];
        yield 'mixed pass/fail with array' => [new Stub(true, false, true), [1, 2, 3]];
        yield 'some fail with ArrayObject' => [Stub::fail(3), new ArrayObject([1, 2, 3])];
        yield 'non-array input' => [Stub::daze(), 'not an array'];
        yield 'string input' => [Stub::daze(), 'string'];
        yield 'integer input' => [Stub::daze(), 123];
        yield 'null input' => [Stub::daze(), null];
        yield 'boolean input' => [Stub::daze(), true];
        yield 'object input' => [Stub::daze(), (object) ['foo' => 'bar']];
        yield 'empty array' => [Stub::daze(), []];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldValidateValidInput(Stub $stub, mixed $input): void
    {
        $validator = new All($stub);
        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldValidateInvalidInput(Stub $stub, mixed $input): void
    {
        $validator = new All($stub);
        self::assertInvalidInput($validator, $input);
    }
}
