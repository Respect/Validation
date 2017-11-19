<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\KeySet
 * @covers \Respect\Validation\Exceptions\KeySetException
 */
class KeySetTest extends TestCase
{
    public function testShouldAcceptKeyRule(): void
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $keySet = new KeySet($key);

        $rules = $keySet->getRules();

        self::assertSame(current($rules), $key);
    }

    public function testShouldAcceptAllOfWithOneKeyRule(): void
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $allOf = new AllOf($key);
        $keySet = new KeySet($allOf);

        $rules = $keySet->getRules();

        self::assertSame(current($rules), $key);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage AllOf rule must have only one Key rule
     */
    public function testShouldNotAcceptAllOfWithMoreThanOneKeyRule(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);
        $allOf = new AllOf($key1, $key2);

        new KeySet($allOf);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function testShouldNotAcceptAllOfWithANonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();
        $allOf = new AllOf($alwaysValid);

        new KeySet($allOf);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function testShouldNotAcceptANonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();

        new KeySet($alwaysValid);
    }

    public function testShouldReturnKeys(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        self::assertEquals(['foo', 'bar'], $keySet->getKeys());
    }

    public function testShouldValidateKeysWhenThereAreMissingRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    public function testShouldValidateKeysWhenThereAreMissingNonRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        self::assertTrue($keySet->validate($input));
    }

    public function testShouldValidateKeysWhenThereAreMoreKeys(): void
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

    public function testShouldValidateKeysWhenEmpty(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "foo", "bar" }`
     */
    public function testShouldCheckKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->check($input);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "foo", "bar" }`
     */
    public function testShouldAssertKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->assert($input);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "name" }`
     * @dataProvider providerForInvalidArguments
     */
    public function testShouldThrowExceptionInCaseArgumentIsAnythingOtherThanArray($input): void
    {
        $keySet = new KeySet(new Key('name'));
        $keySet->assert($input);
    }

    public function providerForInvalidArguments()
    {
        return [
            [''],
            [null],
            [0],
            [new \stdClass()],
        ];
    }
}
