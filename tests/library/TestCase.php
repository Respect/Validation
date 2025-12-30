<?php

declare(strict_types=1);

namespace Respect\Validation\Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Respect\Validation\Rule;
use Respect\Validation\Test\Stubs\WithProperties;
use Respect\Validation\Test\Stubs\WithStaticProperties;
use Respect\Validation\Test\Stubs\WithUninitialized;
use stdClass;

use function implode;
use function ltrim;
use function realpath;
use function Respect\Stringifier\stringify;
use function sprintf;
use function strrchr;
use function substr;

abstract class TestCase extends PHPUnitTestCase
{
    public static function fixture(string|null $filename = null): string
    {
        $parts = [(string) realpath(__DIR__ . '/../fixtures')];
        if ($filename !== null) {
            $parts[] = ltrim($filename, '/');
        }

        return implode('/', $parts);
    }

    public static function assertValidInput(Rule $rule, mixed $input): void
    {
        $result = $rule->evaluate($input);

        self::assertTrue(
            $result->hasPassed,
            sprintf(
                '%s should pass with input %s and parameters %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($input),
                stringify($result->parameters),
            ),
        );
    }

    public static function assertInvalidInput(Rule $rule, mixed $input): void
    {
        $result = $rule->evaluate($input);

        self::assertFalse(
            $result->hasPassed,
            sprintf(
                '%s should fail with input %s and parameters %s',
                substr((string) strrchr($rule::class, '\\'), 1),
                stringify($input),
                stringify($result->parameters),
            ),
        );
    }

    public static function providerForAnyValues(): DataProvider
    {
        return new DataProvider((include __DIR__ . '/../fixtures/data-provider.php'));
    }

    public static function providerForScalarValues(): DataProvider
    {
        return self::providerForAnyValues()->withAny('stringType', 'boolType', 'intType', 'floatType');
    }

    public static function providerForEmptyScalarValues(): DataProvider
    {
        return self::providerForAnyValues()->withAny('stringType', 'boolType')->with('empty');
    }

    public static function providerForNonScalarValues(): DataProvider
    {
        return self::providerForAnyValues()->without('stringType', 'boolType', 'intType', 'floatType');
    }

    public static function providerForNonIterableTypes(): DataProvider
    {
        return self::providerForAnyValues()->without('iterableType');
    }

    public static function providerForIterableTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('iterableType');
    }

    public static function providerForNonEmptyIterableValues(): DataProvider
    {
        return self::providerForAnyValues()->with('iterableType')->without('empty');
    }

    public static function providerForEmptyIterableValues(): DataProvider
    {
        return self::providerForAnyValues()->with('iterableType', 'empty');
    }

    public static function providerForStringTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('stringType');
    }

    public static function providerForCountable(): DataProvider
    {
        return self::providerForAnyValues()->with('countable');
    }

    public static function providerForNonEmptyStringTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('stringType')->without('empty');
    }

    public static function providerForNonStringTypes(): DataProvider
    {
        return self::providerForAnyValues()->without('stringType');
    }

    public static function providerForIntegerTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('intType');
    }

    public static function providerForBooleanTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('boolType');
    }

    public static function providerForFloatTypes(): DataProvider
    {
        return self::providerForAnyValues()->with('floatType');
    }

    public static function providerForNonArrayTypes(): DataProvider
    {
        return self::providerForAnyValues()->without('arrayType');
    }

    public static function providerForNonObjectTypes(): DataProvider
    {
        return self::providerForAnyValues()->without('objectType');
    }

    public static function providerForObjectTypesWithoutAttributes(): DataProvider
    {
        return self::providerForAnyValues()->with('objectType')->without('withAttributes');
    }

    public static function providerForNonArrayValues(): DataProvider
    {
        return self::providerForAnyValues()->without('arrayType', 'ArrayObject');
    }

    public static function providerForUndefined(): DataProvider
    {
        return self::providerForAnyValues()->with('undefined');
    }

    public static function providerForNotUndefined(): DataProvider
    {
        return self::providerForAnyValues()->without('undefined');
    }

    public static function providerForResourceType(): DataProvider
    {
        return self::providerForAnyValues()->with('resourceType');
    }

    public static function providerForNonResourceType(): DataProvider
    {
        return self::providerForAnyValues()->without('resourceType');
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
