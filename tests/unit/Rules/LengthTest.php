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
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

use function range;
use function tmpfile;

#[Group('rule')]
#[CoversClass(Length::class)]
final class LengthTest extends RuleTestCase
{
    #[Test]
    public function isShouldNotNotAcceptInvalidLengths(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('10 cannot be less than 1 for validation');

        new Length(10, 1);
    }

    /**
     * @return array<array{Length, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Length(1, 15), 'alganet'],
            [new Length(4, 6), 'ççççç'],
            [new Length(1, 30), range(1, 20)],
            [new Length(0, 2), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, null), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 15), 'alganet'], //null is a valid min length, means "no minimum"
            [new Length(1, 15, false), 'alganet'],
            [new Length(4, 6, false), 'ççççç'],
            [new Length(1, 30, false), range(1, 20)],
            [new Length(1, 3, false), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, null, false), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 15, false), 'alganet'], //null is a valid min length, means "no minimum"
            [new Length(1, 15), new CountableStub(5)],
            [new Length(1, 15), 12345],
        ];
    }

    /**
     * @return array<array{Length, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Length(1, 15), ''],
            [new Length(1, 6), 'alganet'],
            [new Length(1, 19), range(1, 20)],
            [new Length(8, null), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 6), 'alganet'], //null is a valid min length, means "no minimum"
            [new Length(1, 7, false), 'alganet'],
            [new Length(3, 5, false), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, 30, false), range(1, 50)],
            [new Length(0), tmpfile()],
            [new Length(1, 4), new CountableStub(5)],
            [new Length(1, 4), 12345],
        ];
    }
}
