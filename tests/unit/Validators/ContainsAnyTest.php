<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kirill Dlussky <kirill@dlussky.ru>
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
            [new ContainsAny([true]), [true]],
            [new ContainsAny([1]), [1, 2, 3]],
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
            [new ContainsAny(['foo', 'qux']), 'barbaz'],
            [new ContainsAny([1, 2, 3]), ['1', '2', '3']],
            [new ContainsAny(['word', '@', '/']), 'lorem ipsum'],
        ];
    }
}
