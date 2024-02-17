<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

use function rand;

#[Group('rule')]
#[CoversClass(LazyConsecutive::class)]
final class LazyConsecutiveTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowAnExceptionWhenRuleCreatorDoesNotReturnValidatable(): void
    {
        // @phpstan-ignore-next-line
        $rule = new LazyConsecutive(static fn () => null);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('LazyConsecutive failed because it could not create rule #1');

        $rule->evaluate('something');
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldPassInputToTheRuleCreators(mixed $input): void
    {
        $rule = new LazyConsecutive(static fn ($creatorInput) => Stub::fail(1));

        self::assertEquals(
            Stub::fail(1)->evaluate($input),
            $rule->evaluate($input)
        );
    }

    /** @return iterable<string, array{LazyConsecutive, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            '1st pass' => [new LazyConsecutive(static fn () => Stub::pass(1)), true],
            '1st pass + 2nd pass' => [
                new LazyConsecutive(static fn () => Stub::pass(1), static fn () => Stub::pass(1)),
                true,
            ],
        ];
    }

    /** @return iterable<string, array{LazyConsecutive, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            '1st fail' => [
                new LazyConsecutive(
                    static fn () => Stub::fail(1),
                    static fn () => Stub::daze(),
                ),
                rand(),
            ],
            '1st pass + 2nd fail' => [
                new LazyConsecutive(
                    static fn () => Stub::pass(1),
                    static fn () => Stub::fail(1),
                    static fn () => Stub::daze(),
                ),
                rand(),
            ],
        ];
    }
}
