<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(AnyOf::class)]
final class AnyOfTest extends TestCase
{
    /** @return iterable<string, array{AnyOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, pass' => [new AnyOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, fail' => [new AnyOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, fail, pass' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, fail' => [new AnyOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, fail' => [new AnyOf(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{AnyOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateShortCircuitValidInput(AnyOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateShortCircuitValidInput(AnyOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateValidInput(AnyOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateValidInput(AnyOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitStopEvaluatingAfterFirstSuccess(): void
    {
        $stub1 = new Stub(true);
        $stub2 = Stub::daze();
        $stub3 = Stub::daze();
        $validator = new AnyOf($stub1, $stub2, $stub3);

        $result = $validator->evaluateShortCircuit([]);

        self::assertTrue($result->hasPassed);
        self::assertCount(1, $stub1->inputs);
        self::assertCount(0, $stub2->inputs);
        self::assertCount(0, $stub3->inputs);
    }
}
