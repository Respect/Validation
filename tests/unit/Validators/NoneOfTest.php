<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(NoneOf::class)]
final class NoneOfTest extends RuleTestCase
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
    public function isValid(NoneOf $noneOf, mixed $input): void
    {
        self::assertTrue($noneOf->isValid($input));
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function notIsValid(NoneOf $noneOf, mixed $input): void
    {
        self::assertFalse($noneOf->isValid($input));
    }

    #[Test]
    public function shouldRecursivelyCheckIsValid(): void
    {
        $validator = new NoneOf(
            new AllOf(
                Stub::pass(2),
                Stub::fail(2),
            ),
            Stub::fail(1),
        );

        self::assertTrue($validator->isValid('any value'));
    }
}
