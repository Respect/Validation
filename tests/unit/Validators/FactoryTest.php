<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(Factory::class)]
final class FactoryTest extends TestCase
{
    #[Test]
    public function itShouldThrowAnExceptionWhenRuleCreatorDoesNotReturnRule(): void
    {
        // @phpstan-ignore-next-line
        $validator = new Factory(static fn() => null);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Factory could not create validator');

        $validator->evaluate('something');
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldInvalidInputWhenCreatedRuleFails(mixed $input): void
    {
        self::assertInvalidInput(new Factory(static fn($creatorInput) => Stub::fail(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldValidInputWhenCreatedRulePasses(mixed $input): void
    {
        self::assertValidInput(new Factory(static fn($creatorInput) => Stub::pass(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldReturnTheResultFromTheCreatedRule(mixed $input): void
    {
        $expected = Stub::fail(1)->evaluate($input);

        $validator = new Factory(static fn($creatorInput) => Stub::fail(1));
        $actual = $validator->evaluate($input);

        self::assertEquals($expected, $actual);
    }
}
