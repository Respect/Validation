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
use stdClass;

use function tmpfile;

#[Group(' rule')]
#[CoversClass(Type::class)]
final class TypeTest extends RuleTestCase
{
    #[Test]
    public function shouldThrowExceptionWhenTypeIsNotValid(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessageMatches('/"whatever" is not a valid type \(Available: .+\)/');

        new Type('whatever');
    }

    /**
     * @return array<array{Type, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Type('array'), []],
            [new Type('bool'), true],
            [new Type('boolean'), false],
            [
                new Type('callable'),
                static function (): void {
                },
            ],
            [new Type('double'), 0.8],
            [new Type('float'), 1.0],
            [new Type('int'), 42],
            [new Type('integer'), 13],
            [new Type('null'), null],
            [new Type('object'), new stdClass()],
            [new Type('resource'), tmpfile()],
            [new Type('string'), 'Something'],
        ];
    }

    /**
     * @return array<array{Type, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Type('int'), '1'],
            [new Type('bool'), '1'],
        ];
    }
}
