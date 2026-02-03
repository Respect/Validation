<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Caio César Tavares <caiotava@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Id;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(Not::class)]
final class NotTest extends RuleTestCase
{
    #[Test]
    public function shouldInvertTheResultOfWrappedRule(): void
    {
        $wrapped = Stub::fail(2);

        $validator = new Not($wrapped);

        self::assertEquals(
            $validator->evaluate('input'),
            $wrapped->evaluate('input')->withId(new Id('notStub'))->withToggledModeAndValidation(),
        );
    }

    #[Test]
    public function shouldPassOnIndeterminateResults(): void
    {
        $validator = new Not(new All(new IntVal()));
        $validator->evaluate([]);
        self::assertTrue($validator->evaluate([])->hasPassed);
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
