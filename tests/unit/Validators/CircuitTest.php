<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

use function rand;

#[Group('validator')]
#[CoversClass(Circuit::class)]
final class CircuitTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldValidateInputWhenAllValidatorsValidatesTheInput(mixed $input): void
    {
        self::assertValidInput(new Circuit(Stub::pass(1), Stub::pass(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForFailingValidators')]
    public function itShouldExecuteValidatorsInSequenceUntilOneFails(Stub ...$stub): void
    {
        $validator = new Circuit(...$stub);

        self::assertInvalidInput($validator, rand());
    }

    #[Test]
    public function itShouldReturnTheResultOfTheFailingRule(): void
    {
        $input = rand();

        $validator = new Circuit(Stub::fail(1), Stub::daze());

        $actual = $validator->evaluate($input);
        $expected = Stub::fail(1)->evaluate($input);

        self::assertEquals($expected, $actual);
    }

    /** @return array<array<Stub>> */
    public static function providerForFailingValidators(): array
    {
        return [
            'first fails' => [Stub::fail(1), Stub::daze()],
            'second fails' => [Stub::pass(1), Stub::fail(1), Stub::daze()],
            'third fails' => [Stub::pass(1), Stub::fail(1), Stub::fail(1), Stub::daze(), Stub::daze()],
        ];
    }
}
