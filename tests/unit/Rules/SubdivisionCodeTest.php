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

#[Group('rule')]
#[CoversClass(SubdivisionCode::class)]
final class SubdivisionCodeTest extends RuleTestCase
{
    #[Test]
    public function shouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"whatever" is not a supported country code');

        new SubdivisionCode('whatever');
    }

    #[Test]
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"JK" is not a supported country code');

        new SubdivisionCode('JK');
    }

    /** @return iterable<array{SubdivisionCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new SubdivisionCode('AQ'), null],
            [new SubdivisionCode('BR'), 'SP'],
            [new SubdivisionCode('MV'), '00'],
            [new SubdivisionCode('US'), 'CA'],
            [new SubdivisionCode('YT'), ''],
        ];
    }

    /** @return iterable<array{SubdivisionCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new SubdivisionCode('BR'), 'CA'],
            [new SubdivisionCode('MV'), 0],
            [new SubdivisionCode('US'), 'CE'],
        ];
    }
}
