<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(SubdivisionCode::class)]
final class SubdivisionCodeTest extends RuleTestCase
{
    #[Test]
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('"whatever" is not a supported country code');

        new SubdivisionCode('whatever');
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
