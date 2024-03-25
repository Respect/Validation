<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[CoversClass(InvalidRuleConstructorException::class)]
final class InvalidRuleConstructorExceptionTest extends TestCase
{
    /** @param array<string|array<string>> $arguments */
    #[Test]
    #[DataProvider('providerForMessages')]
    public function itShouldCreateMessageForWithString(string $expect, string $format, array $arguments): void
    {
        $exception = new InvalidRuleConstructorException($format, ...$arguments);

        self::assertEquals($expect, $exception->getMessage());
    }

    /** @return array<string, array{0: string, 1: string, 2: array<string|array<string>>}> */
    public static function providerForMessages(): array
    {
        return [
            'with 1 argument' => ['-arg-', '-%s-', ['arg']],
            'with 2 arguments' => ['-arg1- _arg2_', '-%s- _%s_', ['arg1', 'arg2']],
            'with an array of 1 elements' => ['_"arg1"_', '_%s_', [['arg1']]],
            'with an array of 2 elements' => ['_"arg1" and "arg2"_', '_%s_', [['arg1', 'arg2']]],
            'with an array of 3+ elements' => ['_"arg1", "arg2", and "arg3"_', '_%s_', [['arg1', 'arg2', 'arg3']]],
        ];
    }
}
