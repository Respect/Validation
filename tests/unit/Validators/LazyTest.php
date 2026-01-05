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
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(Lazy::class)]
final class LazyTest extends TestCase
{
    #[Test]
    public function itShouldThrowAnExceptionWhenRuleCreatorDoesNotReturnRule(): void
    {
        // @phpstan-ignore-next-line
        $validator = new Lazy(static fn() => null);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Lazy failed because it could not create the rule');

        $validator->evaluate('something');
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldInvalidInputWhenCreatedRuleFails(mixed $input): void
    {
        self::assertInvalidInput(new Lazy(static fn($creatorInput) => Stub::fail(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldValidInputWhenCreatedRulePasses(mixed $input): void
    {
        self::assertValidInput(new Lazy(static fn($creatorInput) => Stub::pass(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldReturnTheResultFromTheCreatedRule(mixed $input): void
    {
        $expected = Stub::fail(1)->evaluate($input);

        $validator = new Lazy(static fn($creatorInput) => Stub::fail(1));
        $actual = $validator->evaluate($input);

        self::assertEquals($expected, $actual);
    }
}
