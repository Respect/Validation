<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
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
        yield 'empty array' => [Stub::daze(), []];
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

    #[Test]
    public function shouldShortCircuitOnFirstFailure(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit([1, 2, 3]);

        self::assertFalse($result->hasPassed);
        self::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitPassWhenAllItemsPass(): void
    {
        $stub = Stub::pass(3);
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit([1, 2, 3]);

        self::assertTrue($result->hasPassed);
        self::assertCount(3, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitFailForNonIterableInput(): void
    {
        $stub = Stub::daze();
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit('not an array');

        self::assertFalse($result->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitReturnIndeterminateForEmptyArray(): void
    {
        $stub = Stub::daze();
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit([]);

        self::assertTrue($result->hasPassed);
        self::assertTrue($result->isIndeterminate);
    }

    #[Test]
    public function shouldShortCircuitWorkWithIterator(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit(new ArrayIterator([1, 2, 3]));

        self::assertFalse($result->hasPassed);
        self::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitIncludePathOnFailure(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new All($stub);

        $result = $validator->evaluateShortCircuit(['a' => 1, 'b' => 2, 'c' => 3]);

        self::assertFalse($result->hasPassed);
        self::assertSame('b', $result->path?->value);
    }
}
