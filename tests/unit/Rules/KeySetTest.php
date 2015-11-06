<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use PHPUnit_Framework_TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\KeySet
 * @covers Respect\Validation\Exceptions\KeySetException
 */
class KeySetTest extends PHPUnit_Framework_TestCase
{
    public function testShouldAcceptKeyRule()
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $keySet = new KeySet($key);

        $rules = $keySet->getRules();

        $this->assertSame(current($rules), $key);
    }

    public function testShouldAcceptAllOfWithOneKeyRule()
    {
        $key = new Key('foo', new AlwaysValid(), false);
        $allOf = new AllOf($key);
        $keySet = new KeySet($allOf);

        $rules = $keySet->getRules();

        $this->assertSame(current($rules), $key);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage AllOf rule must have only one Key rule
     */
    public function testShouldNotAcceptAllOfWithMoreThanOneKeyRule()
    {
        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);
        $allOf = new AllOf($key1, $key2);

        new KeySet($allOf);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function testShouldNotAcceptAllOfWithANonKeyRule()
    {
        $alwaysValid = new AlwaysValid();
        $allOf = new AllOf($alwaysValid);

        new KeySet($allOf);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage KeySet rule accepts only Key rules
     */
    public function testShouldNotAcceptANonKeyRule()
    {
        $alwaysValid = new AlwaysValid();

        new KeySet($alwaysValid);
    }

    public function testShouldReturnKeys()
    {
        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        $this->assertEquals(['foo', 'bar'], $keySet->getKeys());
    }

    public function testShouldValidateKeysWhenThereAreMissingRequiredKeys()
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        $this->assertFalse($keySet->validate($input));
    }

    public function testShouldValidateKeysWhenThereAreMissingNonRequiredKeys()
    {
        $input = [
            'foo' => 42,
        ];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        $this->assertTrue($keySet->validate($input));
    }

    public function testShouldValidateKeysWhenThereAreMoreKeys()
    {
        $input = [
            'foo' => 42,
            'bar' => 'String',
            'baz' => false,
        ];

        $key1 = new Key('foo', new AlwaysValid(), false);
        $key2 = new Key('bar', new AlwaysValid(), false);

        $keySet = new KeySet($key1, $key2);

        $this->assertFalse($keySet->validate($input));
    }

    public function testShouldValidateKeysWhenEmpty()
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);

        $this->assertFalse($keySet->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys { "foo", "bar" }
     */
    public function testShouldCheckKeys()
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->check($input);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeySetException
     * @expectedExceptionMessage Must have keys { "foo", "bar" }
     */
    public function testShouldAssertKeys()
    {
        $input = [];

        $key1 = new Key('foo', new AlwaysValid(), true);
        $key2 = new Key('bar', new AlwaysValid(), true);

        $keySet = new KeySet($key1, $key2);
        $keySet->assert($input);
    }
}
