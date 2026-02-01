<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Bradyn Poulsen <bradyn@bradynpoulsen.com>
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
#[CoversClass(OneOf::class)]
final class OneOfTest extends TestCase
{
    /** @return iterable<string, array{OneOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, pass' => [new OneOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, fail' => [new OneOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, fail' => [new OneOf(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, pass, fail' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, fail, pass' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []];
    }

    /** @return iterable<string, array{OneOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, pass, pass' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateShortCircuitValidInput(OneOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateShortCircuitValidInput(OneOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateValidInput(OneOf $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateValidInput(OneOf $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitStopEvaluatingAfterSecondSuccess(): void
    {
        $stub1 = new Stub(true);
        $stub2 = new Stub(true);
        $stub3 = Stub::daze();
        $validator = new OneOf($stub1, $stub2, $stub3);

        $result = $validator->evaluateShortCircuit([]);

        self::assertFalse($result->hasPassed);
        self::assertCount(1, $stub1->inputs);
        self::assertCount(1, $stub2->inputs);
        self::assertCount(0, $stub3->inputs);
    }
}
