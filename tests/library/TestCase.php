<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use ArrayObject;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Respect\Validation\Validatable;
use stdClass;

use function array_merge;
use function implode;
use function ltrim;
use function realpath;
use function Respect\Stringifier\stringify;
use function sprintf;
use function strrchr;
use function substr;
use function tmpfile;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

abstract class TestCase extends PHPUnitTestCase
{
    public static function fixture(?string $filename = null): string
    {
        $parts = [(string) realpath(__DIR__ . '/../fixtures')];
        if ($filename !== null) {
            $parts[] = ltrim($filename, '/');
        }

        return implode('/', $parts);
    }

    public static function assertValidInput(Validatable $rule, mixed $input): void
    {
        $result = $rule->evaluate($input);

        self::assertTrue(
            $result->isValid,
            sprintf(
                '%s should pass with input %s and parameters %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($input),
                stringify($result->parameters)
            )
        );
    }

    public static function assertInvalidInput(Validatable $rule, mixed $input): void
    {
        $result = $rule->evaluate($input);

        self::assertFalse(
            $result->isValid,
            sprintf(
                '%s should fail with input %s and parameters %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($input),
                stringify($result->parameters)
            )
        );
    }

    /** @return array<array{mixed}> */
    public static function providerForAnyValues(): array
    {
        return array_merge(
            self::providerForStringValues(),
            self::providerForNonScalarValues(),
            self::providerForEmptyIterableValues(),
            self::providerForNonEmptyIterableValues(),
            self::providerForNonIterableValues(),
            self::providerForIntegerValues(),
            self::providerForBooleanValues(),
            self::providerForFloatValues(),
        );
    }

    /** @return array<array{scalar}> */
    public static function providerForScalarValues(): array
    {
        return array_merge(
            self::providerForStringValues(),
            self::providerForIntegerValues(),
            self::providerForBooleanValues(),
            self::providerForFloatValues(),
        );
    }

    /** @return array<array{mixed}> */
    public static function providerForNonScalarValues(): array
    {
        return self::providerForNonEmptyIterableValues() + self::providerForNonEmptyIterableValues() + [
            'closure' => [static fn() => 'foo'],
            'stdClass' => [new stdClass()],
            'null' => [null],
            'resource' => [tmpfile()],
        ];
    }

    /** @return array<array{mixed}> */
    public static function providerForNonIterableValues(): array
    {
        return array_merge(
            self::providerForScalarValues(),
            [
                'closure' => [static fn() => 'foo'],
                'stdClass' => [new stdClass()],
                'null' => [null],
                'resource' => [tmpfile()],
            ]
        );
    }

    /** @return array<array{iterable<mixed>}> */
    public static function providerForIterableValues(): array
    {
        return array_merge(
            self::providerForNonEmptyIterableValues(),
            self::providerForEmptyIterableValues(),
        );
    }

    /** @return array<array{iterable<mixed>}> */
    public static function providerForNonEmptyIterableValues(): array
    {
        return [
            'ArrayObject' => [new ArrayObject([1, 2, 3])],
            'array' => [[4, 5, 6]],
            'generator' => [(static fn() => yield 7)()], // phpcs:ignore
        ];
    }

    /** @return array<array{iterable<mixed>}> */
    public static function providerForEmptyIterableValues(): array
    {
        return [
            'empty ArrayObject' => [new ArrayObject([])],
            'empty array' => [[]],
            'empty generator' => [(static fn() => yield from [])()],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForStringValues(): array
    {
        return [
            'string' => ['string'],
            'empty string' => [''],
            'integer string' => ['500'],
            'float string' => ['56.8'],
            'zero string' => ['0'],
        ];
    }

    /** @return array<array{mixed}> */
    public static function providerForNonStringValues(): array
    {
        return array_merge(
            self::providerForNonScalarValues(),
            self::providerForIntegerValues(),
            self::providerForBooleanValues(),
            self::providerForFloatValues(),
        );
    }

    /** @return array<array{int}> */
    public static function providerForIntegerValues(): array
    {
        return [
            'zero integer' => [0],
            'positive integer' => [PHP_INT_MAX],
            'negative integer' => [PHP_INT_MIN],
        ];
    }

    /** @return array<array{bool}> */
    public static function providerForBooleanValues(): array
    {
        return [
            'true' => [true],
            'false' => [false],
        ];
    }

    /** @return array<array{float}> */
    public static function providerForFloatValues(): array
    {
        return [
            'zero float' => [0.0],
            'negative float' => [-893.1],
            'positive float' => [32.890],
        ];
    }
}
