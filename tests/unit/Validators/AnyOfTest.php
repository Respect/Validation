<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andre Ramaciotti <andre@ramaciotti.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pascal Borreli <pascal@borreli.com>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 * SPDX-FileContributor: Vicente Mendoza <vicentemmor@yahoo.com.mx>
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
#[CoversClass(AnyOf::class)]
final class AnyOfTest extends RuleTestCase
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
    public function isValid(AnyOf $anyOf, mixed $input): void
    {
        self::assertTrue($anyOf->isValid($input));
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function notIsValid(AnyOf $anyOf, mixed $input): void
    {
        self::assertFalse($anyOf->isValid($input));
    }

    #[Test]
    public function shouldRecursivelyCheckIsValid(): void
    {
        $validator = new AnyOf(
            new AllOf(
                Stub::pass(2),
                Stub::fail(2),
            ),
            new AnyOf(
                Stub::fail(2),
                Stub::pass(2),
            ),
            Stub::fail(1),
        );

        self::assertTrue($validator->isValid('any value'));
    }
}
