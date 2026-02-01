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
#[CoversClass(NoneOf::class)]
final class NoneOfTest extends TestCase
{
    /** @return iterable<string, array{NoneOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{NoneOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'pass, fail' => [new NoneOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, pass, fail' => [new NoneOf(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, pass' => [new NoneOf(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateShortCircuitValidInput(NoneOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateShortCircuitValidInput(NoneOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateValidInput(NoneOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateValidInput(NoneOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitStopEvaluatingAfterFirstFailure(): void
    {
        $stub1 = new Stub(true);
        $stub2 = Stub::daze();
        $stub3 = Stub::daze();
        $validator = new NoneOf($stub1, $stub2, $stub3);

        $result = $validator->evaluateShortCircuit([]);

        self::assertFalse($result->hasPassed);
        self::assertCount(1, $stub1->inputs);
        self::assertCount(0, $stub2->inputs);
        self::assertCount(0, $stub3->inputs);
    }
}
