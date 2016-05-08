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
 * @covers \Respect\Validation\Rules\KeyValue
 * @covers \Respect\Validation\Exceptions\KeyValueException
 */
class KeyValueTest extends TestCase
{
    protected function setUp(): void
    {
        $this->markTestSkipped('KeyValue needs to be refactored');

        StaticTestSpy::reset();
    }

    public function testShouldDefineValuesOnConstructor(): void
    {
        $comparedKey = 'foo';
        $ruleName = 'staticTestSpy';
        $baseKey = 'bar';

        $rule = new KeyValue($comparedKey, $ruleName, $baseKey);

        self::assertSame($comparedKey, $rule->comparedKey);
        self::assertSame($ruleName, $rule->ruleName);
        self::assertSame($baseKey, $rule->baseKey);
    }

    public function testShouldNotValidateWhenComparedKeyDoesNotExist(): void
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertFalse($rule->validate(['bar' => 42]));
    }

    public function testShouldNotValidateWhenBaseKeyDoesNotExist(): void
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertFalse($rule->validate(['foo' => true]));
    }

    public function testShouldNotValidateRuleIsNotValid(): void
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');

        self::assertFalse($rule->validate(['foo' => true, 'bar' => false]));
    }

    public function testShouldValidateWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertTrue($rule->validate(['foo' => 42, 'bar' => 42]));
    }

    public function testShouldValidateWhenDefinedValuesDoesNotMatch(): void
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertFalse($rule->validate(['foo' => 43, 'bar' => 42]));
    }

    public function testShouldAssertWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertTrue($rule->assert(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Exception from `StaticTestSpy::assert()
     */
    public function testShouldAssertWhenDefinedValuesDoesNotMatch(): void
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyValueException
     * @expectedExceptionMessage "bar" must be valid to validate "foo"
     */
    public function testShouldNotAssertWhenRuleIsNotValid(): void
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    public function testShouldCheckWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');

        self::assertTrue($rule->check(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EqualsException
     * @expectedExceptionMessage foo must equal "bar"
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Exception from `StaticTestSpy::check()` method
     */
    public function testShouldCheckWhenDefinedValuesDoesNotMatch(): void
    {
        StaticTestSpy::$result = false;

        $rule = new KeyValue('foo', 'staticTestSpy', 'bar');
        $rule->check(['foo' => 43, 'bar' => 42]);
    }
}
