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
use Respect\StringFormatter\PatternFormatter;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[CoversClass(Patterned::class)]
final class PatternedTest extends TestCase
{
    #[Test]
    public function shouldNotAllowCreatingValidatorWithAnInvalidPattern(): void
    {
        $pattern = '';

        $this->expectException(InvalidValidatorException::class);

        new Patterned($pattern, Stub::daze());
    }

    #[Test]
    #[DataProvider('providerForNonStringValues')]
    public function shouldNotValidateWhenInputIsNotStringValue(mixed $input): void
    {
        $this->assertInvalidInput(new Patterned('0{3}.0{3}.0{3}-0{2}', Stub::any(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForStringValues')]
    public function shouldFormatTheInputWhenInputIsStringValue(mixed $input): void
    {
        $patternFormatter = new PatternFormatter('0{3}.0{3}.0{3}-0{2}');

        $stub = Stub::pass(2);
        $comparableResult = $stub->evaluate($input);

        $validator = new Patterned('0{3}.0{3}.0{3}-0{2}', $stub);

        $result = $validator->evaluate($input);

        self::assertSame($patternFormatter->format((string) $input), $result->input);
        self::assertSame($comparableResult->hasPassed, $result->hasPassed);
        self::assertSame($comparableResult->validator, $result->validator);
    }
}
