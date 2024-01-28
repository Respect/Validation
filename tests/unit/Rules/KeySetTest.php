<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\KeySetException;
use Respect\Validation\Test\TestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(KeySet::class)]
final class KeySetTest extends TestCase
{
    #[Test]
    public function shouldNotAcceptAllOfWithMoreThanOneKeyRule(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);
        $allOf = new AllOf($key1, $key2);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($allOf);
    }

    #[Test]
    public function shouldNotAcceptAllOfWithNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();
        $allOf = new AllOf($alwaysValid);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($allOf);
    }

    #[Test]
    public function shouldNotAcceptNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($alwaysValid);
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMissingRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMissingNonRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        self::assertTrue($keySet->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMoreKeys(): void
    {
        $input = [
            'foo' => 42,
            'bar' => 'String',
            'baz' => false,
        ];

        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenEmpty(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    #[Test]
    public function shouldCheckKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        $this->expectException(KeySetException::class);
        $this->expectExceptionMessage('Must have keys `{ "foo", "bar" }`');

        $keySet->check($input);
    }

    #[Test]
    public function shouldAssertKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        $this->expectException(KeySetException::class);
        $this->expectExceptionMessage('Must have keys `{ "foo", "bar" }`');

        $keySet->assert($input);
    }

    #[Test]
    public function shouldWarnOfExtraKeysWithMessage(): void
    {
        $input = ['foo' => 123, 'bar' => 456];

        $key1 = new Key('foo', new AlwaysValid(), true);

        $keySet = new KeySet($key1);

        $this->expectException(KeySetException::class);
        $this->expectExceptionMessage('Must not have keys `{ "bar" }`');

        $keySet->assert($input);
    }

    #[Test]
    public function cannotBeNegated(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), true);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"Respect\Validation\Rules\KeySet" can not be wrapped in Not()');

        new Not(new KeySet($key1));
    }

    #[Test]
    #[DataProvider('providerForInvalidArguments')]
    public function shouldThrowExceptionInCaseArgumentIsAnythingOtherThanArray(mixed $input): void
    {
        $keySet = new KeySet(new Key('name'));

        $this->expectException(KeySetException::class);
        $this->expectExceptionMessage('Must have keys `{ "name" }`');

        $keySet->assert($input);
    }

    /**
     * @return mixed[][]
     */
    public static function providerForInvalidArguments(): array
    {
        return [
            [''],
            [null],
            [0],
            [new stdClass()],
        ];
    }
}
