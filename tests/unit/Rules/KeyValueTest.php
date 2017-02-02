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
 * @covers Respect\Validation\Rules\KeyValue
 * @covers Respect\Validation\Exceptions\KeyValueException
 */
class KeyValueTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->markTestSkipped('KeyValue needs to be refactored');

        StaticTestSpy::reset();
    }

    public function testShouldDefineValuesOnConstructor()
    {
        $comparedKey = 'foo';
        $ruleName = 'staticTestSpy';
        $baseKey = 'bar';

        $rule = new KeyValue($comparedKey, $ruleName, $baseKey);

        $this->assertSame($comparedKey, $rule->comparedKey);
        $this->assertSame($ruleName, $rule->ruleName);
        $this->assertSame($baseKey, $rule->baseKey);
    }

    public function testShouldNotValidateWhenComparedKeyDoesNotExist()
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertFalse($rule->validate(['bar' => 42]));
    }

    public function testShouldNotValidateWhenBaseKeyDoesNotExist()
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertFalse($rule->validate(['foo' => true]));
    }

    public function testShouldNotValidateRuleIsNotValid()
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');

        $this->assertFalse($rule->validate(['foo' => true, 'bar' => false]));
    }

    public function testShouldValidateWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertTrue($rule->validate(['foo' => 42, 'bar' => 42]));
    }

    public function testShouldValidateWhenDefinedValuesDoesNotMatch()
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertFalse($rule->validate(['foo' => 43, 'bar' => 42]));
    }

    public function testShouldAssertWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertTrue($rule->assert(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Exception from `StaticTestSpy::assert()
     */
    public function testShouldAssertWhenDefinedValuesDoesNotMatch()
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeyValueException
     * @expectedExceptionMessage "bar" must be valid to validate "foo"
     */
    public function testShouldNotAssertWhenRuleIsNotValid()
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    public function testShouldCheckWhenDefinedValuesMatch()
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        $this->assertTrue($rule->check(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Exception from `StaticTestSpy::check()` method
     */
    public function testShouldCheckWhenDefinedValuesDoesNotMatch()
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');
        $rule->check(['foo' => 43, 'bar' => 42]);
    }
}
