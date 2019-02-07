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

use Respect\Validation\Test\TestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\KeySet
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeySetTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAcceptKeyRule(): void
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $keySet = new KeySet($key);

        self::assertAttributeSame([$key], 'keyRules', $keySet);
    }

    /**
     * @test
     */
    public function shouldAcceptAllOfWithOneKeyRule(): void
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $allOf = new AllOf($key);
        $keySet = new KeySet($allOf);

        self::assertAttributeSame([$key], 'keyRules', $keySet);
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function shouldNotAcceptAllOfWithMoreThanOneKeyRule(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);
        $allOf = new AllOf($key1, $key2);

        new KeySet($allOf);
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function shouldNotAcceptAllOfWithNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();
        $allOf = new AllOf($alwaysValid);

        new KeySet($allOf);
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function shouldNotAcceptNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();

        new KeySet($alwaysValid);
    }

    /**
     * @test
     */
    public function shouldReturnKeys(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        self::assertAttributeSame(['foo', 'bar'], 'keys', $keySet);
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function shouldValidateKeysWhenEmpty(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        self::assertFalse($keySet->validate($input));
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "foo", "bar" }`
     */
    public function shouldCheckKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->check($input);
    }

    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "foo", "bar" }`
     */
    public function shouldAssertKeys(): void
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->assert($input);
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidArguments
     *
     * @expectedException \Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys `{ "name" }`
     *
     * @param mixed $input
     */
    public function shouldThrowExceptionInCaseArgumentIsAnythingOtherThanArray($input): void
    {
        $keySet = new KeySet(new Key('name'));
        $keySet->assert($input);
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidArguments(): array
    {
        return [
            [''],
            [null],
            [0],
            [new \stdClass()],
        ];
    }
}
