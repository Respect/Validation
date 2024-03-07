<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use ArrayObject;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Respect\Validation\Test\Stubs\WithProperties;
use Respect\Validation\Test\Stubs\WithStaticProperties;
use Respect\Validation\Test\Stubs\WithUninitialized;
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
            self::providerForStringTypes(),
            self::providerForNonScalarValues(),
            self::providerForEmptyIterableValues(),
            self::providerForNonEmptyIterableValues(),
            self::providerForNonIterableTypes(),
            self::providerForIntegerTypes(),
            self::providerForBooleanTypes(),
            self::providerForFloatTypes(),
        );
    }

    /** @return array<array{scalar}> */
    public static function providerForScalarValues(): array
    {
        return array_merge(
            self::providerForStringTypes(),
            self::providerForIntegerTypes(),
            self::providerForBooleanTypes(),
            self::providerForFloatTypes(),
        );
    }

    /** @return array<array{scalar}> */
    public static function providerForEmptyScalarValues(): array
    {
        return [
            'empty string' => [''],
            'false' => [false],
        ];
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
    public static function providerForNonIterableTypes(): array
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
    public static function providerForIterableTypes(): array
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
    public static function providerForStringTypes(): array
    {
        return [
            'string' => ['string'],
            'empty string' => [''],
            'integer string' => ['500'],
            'float string' => ['56.8'],
            'zero string' => ['0'],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForNonEmptyStringTypes(): array
    {
        $dataProvider = self::providerForStringTypes();
        unset($dataProvider['empty string']);

        return $dataProvider;
    }

    /** @return array<array{mixed}> */
    public static function providerForNonStringTypes(): array
    {
        return array_merge(
            self::providerForNonScalarValues(),
            self::providerForIntegerTypes(),
            self::providerForBooleanTypes(),
            self::providerForFloatTypes(),
        );
    }

    /** @return array<array{int}> */
    public static function providerForIntegerTypes(): array
    {
        return [
            'zero integer' => [0],
            'positive integer' => [PHP_INT_MAX],
            'negative integer' => [PHP_INT_MIN],
        ];
    }

    /** @return array<array{bool}> */
    public static function providerForBooleanTypes(): array
    {
        return [
            'true' => [true],
            'false' => [false],
        ];
    }

    /** @return array<array{float}> */
    public static function providerForFloatTypes(): array
    {
        return [
            'zero float' => [0.0],
            'negative float' => [-893.1],
            'positive float' => [32.890],
        ];
    }

    /** @return array<array{mixed}> */
    public static function providerForNonArrayTypes(): array
    {
        $scalarValues = self::providerForNonScalarValues();
        unset($scalarValues['array']);

        return array_merge(
            self::providerForIntegerTypes(),
            self::providerForBooleanTypes(),
            self::providerForFloatTypes(),
            self::providerForStringTypes(),
            $scalarValues,
        );
    }

    /** @return array<array{mixed}> */
    public static function providerForNonArrayValues(): array
    {
        $arrayTypes = self::providerForNonArrayTypes();
        unset($arrayTypes['ArrayObject']);

        return $arrayTypes;
    }

    /** @return array<string, array{string|int, array<mixed>}> */
    public static function providerForArrayWithMissingKeys(): array
    {
        return [
            'integer key, non-empty input' => [0, [1 => true, 2 => true]],
            'string key, non-empty input' => ['foo', ['bar' => true, 'baz' => true]],
            'integer key, empty input' => [0, []],
            'string key, empty input' => ['foo', []],
        ];
    }

    /** @return array<string, array{string|int, array<mixed>}> */
    public static function providerForArrayWithExistingKeys(): array
    {
        return [
            'integer key with a single value array' => [1, [1 => true]],
            'integer key with a multiple value array' => [2, [1 => true, 2 => true]],
            'string key with a single value array' => ['foo', ['foo' => true, 'bar' => true]],
            'string key with a multiple value array' => ['bar', ['foo' => true, 'bar' => true]],
            'integer key with null for a value' => [0, [null]],
            'string key with null for a value' => ['foo', ['foo' => null]],
            'integer key with false for a value' => [0, [false]],
            'string key with false for a value' => ['foo', ['foo' => false]],
        ];
    }

    /** @return array<array{string, object}> */
    public static function providerForObjectsWithMissingProperties(): array
    {
        return [
            'object with no properties' => ['something', new stdClass()],
            'object with missing property' => ['nonExisting', new WithProperties()],
        ];
    }

    /** @return array<array{string, object}> */
    public static function providerForObjectsWithExistingProperties(): array
    {
        return [
            'public' => ['public', new WithProperties()],
            'protected' => ['protected', new WithProperties()],
            'private' => ['private', new WithProperties()],
            'uninitialized' => ['uninitialized', new WithUninitialized()],
            'static public' => ['public', new WithStaticProperties()],
            'static protected' => ['protected', new WithStaticProperties()],
            'static private' => ['private', new WithStaticProperties()],
        ];
    }
}
