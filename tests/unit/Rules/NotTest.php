<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Not::class)]
final class NotTest extends RuleTestCase
{
    #[Test]
    public function shouldInvertTheResultOfWrappedRule(): void
    {
        $wrapped = Stub::fail(2);

        $rule = new Not($wrapped);

        self::assertEquals(
            $rule->evaluate('input'),
            $wrapped->evaluate('input')->withPrefix('not')->withInvertedMode()
        );
    }

    /** @return iterable<string, array{Not, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'invert fail' => [new Not(Stub::fail(1)), []];
        yield 'invert success x2' => [new Not(new Not(Stub::pass(1))), []];
    }

    /** @return iterable<string, array{Not, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'invert pass' => [new Not(Stub::pass(1)), []];
        yield 'invert fail x2' => [new Not(new Not(Stub::fail(1))), []];
    }
}
