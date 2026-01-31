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
use Respect\Validation\Test\Formatters\FormatterStub;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[CoversClass(Formatted::class)]
final class FormattedTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonStringValues')]
    public function shouldNotValidateWhenInputIsNotStringValue(mixed $input): void
    {
        $this->assertInvalidInput(new Formatted(new FormatterStub('any'), Stub::any(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForStringValues')]
    public function shouldFormatTheInputWhenInputIsStringValue(mixed $input): void
    {
        $formattedValue = 'formatted-value';
        $formatter = new FormatterStub($formattedValue);

        $stub = Stub::pass(2);
        $comparableResult = $stub->evaluate($input);

        $validator = new Formatted($formatter, $stub);

        $result = $validator->evaluate($input);

        self::assertSame($formattedValue, $result->input);
        self::assertSame($comparableResult->hasPassed, $result->hasPassed);
        self::assertSame($comparableResult->validator, $result->validator);
    }

    #[Test]
    public function shouldPassValidationWhenInnerValidatorPasses(): void
    {
        $formatter = new FormatterStub('formatted');
        $validator = new Formatted($formatter, Stub::pass(1));

        $this->assertValidInput($validator, 'any-string');
    }

    #[Test]
    public function shouldFailValidationWhenInnerValidatorFails(): void
    {
        $formatter = new FormatterStub('formatted');
        $validator = new Formatted($formatter, Stub::fail(1));

        $this->assertInvalidInput($validator, 'any-string');
    }
}
