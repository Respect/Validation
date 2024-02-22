<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use stdClass;

use function array_merge;
use function tmpfile;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

abstract class TestCase extends PHPUnitTestCase
{
    /** @return array<array{mixed}> */
    public static function providerForAnyValues(): array
    {
        return array_merge(
            self::providerForStringValues(),
            self::providerForNonScalarValues(),
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
        return [
            'closure' => [static fn() => 'foo'],
            'array' => [[]],
            'object' => [new stdClass()],
            'null' => [null],
            'resource' => [tmpfile()],
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
