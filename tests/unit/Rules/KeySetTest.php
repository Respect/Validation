<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\KeySetException;
use Respect\Validation\Test\TestCase;
use stdClass;

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
    public function shouldNotAcceptAllOfWithMoreThanOneKeyRule(): void
    {
        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);
        $allOf = new AllOf($key1, $key2);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($allOf);
    }

    /**
     * @test
     */
    public function shouldNotAcceptAllOfWithNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();
        $allOf = new AllOf($alwaysValid);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($allOf);
    }

    /**
     * @test
     */
    public function shouldNotAcceptNonKeyRule(): void
    {
        $alwaysValid = new AlwaysValid();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet($alwaysValid);
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
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     *
     * @dataProvider providerForInvalidArguments
     *
     * @param mixed $input
     */
    public function shouldThrowExceptionInCaseArgumentIsAnythingOtherThanArray($input): void
    {
        $keySet = new KeySet(new Key('name'));

        $this->expectException(KeySetException::class);
        $this->expectExceptionMessage('Must have keys `{ "name" }`');

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
            [new stdClass()],
        ];
    }
}
