<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\StringFormatter\MaskFormatter;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[CoversClass(Masked::class)]
final class MaskedTest extends TestCase
{
    #[Test]
    public function shouldNotAllowCreatingValidatorWithAnInvalidRange(): void
    {
        $range = '0-3';

        $this->expectException(InvalidValidatorException::class);

        new Masked($range, Stub::daze());
    }

    #[Test]
    #[DataProvider('providerForNonStringValues')]
    public function shouldNotValidateWhenInputIsNotStringValue(mixed $input): void
    {
        $this->assertInvalidInput(new Masked('1-', Stub::any(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForStringValues')]
    public function shouldMaskTheInputWhenInputIsStringValue(mixed $input): void
    {
        $maskFormatter = new MaskFormatter('1-', '*');

        $stub = Stub::pass(2);
        $comparableResult = $stub->evaluate($input);

        $validator = new Masked('1-', $stub);

        $result = $validator->evaluate($input);

        self::assertSame($maskFormatter->format((string) $input), $result->input);
        self::assertSame($comparableResult->hasPassed, $result->hasPassed);
        self::assertSame($comparableResult->validator, $result->validator);
    }
}
