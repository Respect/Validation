<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(EachKey::class)]
final class EachKeyTest extends TestCase
{
    /** @return iterable<string, array{Stub, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'all keys pass with array' => [Stub::pass(3), ['a' => 1, 'b' => 2, 'c' => 3]];
        yield 'all keys pass with ArrayObject' => [Stub::pass(3), new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3])];
        yield 'single key that passes' => [Stub::pass(1), ['a' => 1]];
        yield 'integer keys pass with array' => [Stub::pass(5), [1, 2, 3, 4, 5]];
        yield 'empty array' => [Stub::daze(), []];
    }

    /** @return iterable<string, array{Stub, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'some keys fail with array' => [Stub::fail(3), ['a' => 1, 'b' => 2, 'c' => 3]];
        yield 'all keys fail with array' => [Stub::fail(3), ['a' => 1, 'b' => 2, 'c' => 3]];
        yield 'mixed pass/fail with array' => [new Stub(true, false, true), ['a' => 1, 'b' => 2, 'c' => 3]];
        yield 'some keys fail with ArrayObject' => [Stub::fail(3), new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3])];
        yield 'non-array input' => [Stub::daze(), 'not an array'];
        yield 'string input' => [Stub::daze(), 'string'];
        yield 'integer input' => [Stub::daze(), 123];
        yield 'null input' => [Stub::daze(), null];
        yield 'boolean input' => [Stub::daze(), true];
        yield 'object input' => [Stub::daze(), (object) ['foo' => 'bar']];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldValidateValidInput(Stub $stub, mixed $input): void
    {
        $validator = new EachKey($stub);
        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldValidateInvalidInput(Stub $stub, mixed $input): void
    {
        $validator = new EachKey($stub);
        self::assertInvalidInput($validator, $input);
    }

    #[Test]
    public function shouldShortCircuitOnFirstFailure(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit(['a' => 1, 'b' => 2, 'c' => 3]);

        self::assertFalse($result->hasPassed);
        self::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitPassWhenAllKeysPass(): void
    {
        $stub = Stub::pass(3);
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit(['a' => 1, 'b' => 2, 'c' => 3]);

        self::assertTrue($result->hasPassed);
        self::assertCount(3, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitFailForNonIterableInput(): void
    {
        $stub = Stub::daze();
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit('not an array');

        self::assertFalse($result->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitReturnIndeterminateForEmptyArray(): void
    {
        $stub = Stub::daze();
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit([]);

        self::assertTrue($result->hasPassed);
        self::assertTrue($result->isIndeterminate);
    }

    #[Test]
    public function shouldShortCircuitWorkWithIterator(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit(new ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3]));

        self::assertFalse($result->hasPassed);
        self::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitIncludePathOnFailure(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new EachKey($stub);

        $result = $validator->evaluateShortCircuit(['a' => 1, 'b' => 2, 'c' => 3]);

        self::assertFalse($result->hasPassed);
        self::assertSame('b', $result->path?->value);
    }
}
