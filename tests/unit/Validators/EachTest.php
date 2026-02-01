<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;
use stdClass;

#[Group('validator')]
#[CoversClass(Each::class)]
final class EachTest extends RuleTestCase
{
    /** @return iterable<array{Each|Not, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Each(Stub::daze()), []],
            [new Not(new Each(Stub::daze())), []],
            [new Each(Stub::pass(5)), [1, 2, 3, 4, 5]],
            [new Each(Stub::pass(5)), new ArrayObject([1, 2, 3, 4, 5])],
        ];
    }

    /** @return iterable<array{Each, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Each(Stub::daze()), new stdClass()],
            [new Each(Stub::daze()), 123],
            [new Each(Stub::daze()), ''],
            [new Each(Stub::daze()), null],
            [new Each(Stub::daze()), false],
            [new Each(Stub::fail(5)), ['', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), ['a', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), new ArrayObject([1, 2, 3, 4, 5])],
            [new Each(Stub::fail(5)), (object) ['foo' => true]],
        ];
    }

    #[Test]
    public function shouldShortCircuitOnFirstFailure(): void
    {
        $stub = new Stub(true, false, true, true, true);
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit([1, 2, 3, 4, 5]);

        TestCase::assertFalse($result->hasPassed);
        TestCase::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitPassWhenAllItemsPass(): void
    {
        $stub = Stub::pass(5);
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit([1, 2, 3, 4, 5]);

        TestCase::assertTrue($result->hasPassed);
        TestCase::assertCount(5, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitFailForNonIterableInput(): void
    {
        $stub = Stub::daze();
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit('not an array');

        TestCase::assertFalse($result->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitReturnPassedForEmptyArray(): void
    {
        $stub = Stub::daze();
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit([]);

        TestCase::assertTrue($result->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitWorkWithIterator(): void
    {
        $stub = new Stub(true, false, true, true, true);
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit(new ArrayIterator([1, 2, 3, 4, 5]));

        TestCase::assertFalse($result->hasPassed);
        TestCase::assertCount(2, $stub->inputs);
    }

    #[Test]
    public function shouldShortCircuitIncludePathOnFailure(): void
    {
        $stub = new Stub(true, false, true, true, true);
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit([1, 2, 3, 4, 5]);

        TestCase::assertFalse($result->hasPassed);
        TestCase::assertSame(1, $result->path?->value);
    }

    #[Test]
    public function shouldShortCircuitWorkWithNamedKeys(): void
    {
        $stub = new Stub(true, false, true);
        $validator = new Each($stub);

        $result = $validator->evaluateShortCircuit(['a' => 1, 'b' => 2, 'c' => 3]);

        TestCase::assertFalse($result->hasPassed);
        TestCase::assertSame('b', $result->path?->value);
    }
}
