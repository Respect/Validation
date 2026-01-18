<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(ContainsAny::class)]
final class ContainsAnyTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowAnExceptionWhenThereAreNoNeedles(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('At least one value must be provided');

        // @phpstan-ignore-next-line
        new ContainsAny([]);
    }

    /** @return iterable<array{ContainsAny, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new ContainsAny(['Something', 'Else']), 'something else'],
            [new ContainsAny([true]), [1, 2, 3]],
            [new ContainsAny([true], true), [true]],
            [new ContainsAny(['1']), [1, 2, 3]],
            [new ContainsAny([1], true), [1, 2, 3]],
            [new ContainsAny(['word', '@', '/']), 'lorem ipsum @ word'],
            [new ContainsAny(['foo', 'qux']), 'foobarbaz'],
            [new ContainsAny(['1']), ['foo', 1]],
            [new ContainsAny(['foo', true]), ['foo', 'bar']],
        ];
    }

    /** @return iterable<array{ContainsAny, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new ContainsAny(['foo']), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar']), ['baz', 'qux']],
            [new ContainsAny(['foo', 'bar']), ['FOO', 'BAR']],
            [new ContainsAny(['foo'], true), ['bar', 'baz']],
            [new ContainsAny(['foo', 'bar'], true), ['FOO', 'BAR']],
            [new ContainsAny(['whatever']), ''],
            [new ContainsAny(['']), 'whatever'],
            [new ContainsAny([false]), ''],
            [new ContainsAny(['foo', 'qux']), 'barbaz'],
            [new ContainsAny([1, 2, 3], true), ['1', '2', '3']],
            [new ContainsAny(['word', '@', '/']), 'lorem ipsum'],
        ];
    }
}
