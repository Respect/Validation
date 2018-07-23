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
 * @covers \Respect\Validation\Exceptions\KeyValueException
 * @covers \Respect\Validation\Rules\KeyValue
 */
class KeyValueTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDefineValuesOnConstructor(): void
    {
        $comparedKey = 'foo';
        $ruleName = 'equals';
        $baseKey = 'bar';

        $rule = new KeyValue($comparedKey, $ruleName, $baseKey);

        self::assertSame($comparedKey, $rule->comparedKey);
        self::assertSame($ruleName, $rule->ruleName);
        self::assertSame($baseKey, $rule->baseKey);
    }

    /**
     * @test
     */
    public function shouldNotValidateWhenComparedKeyDoesNotExist(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['bar' => 42]));
    }

    /**
     * @test
     */
    public function shouldNotValidateWhenBaseKeyDoesNotExist(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['foo' => true]));
    }

    /**
     * @test
     */
    public function shouldNotValidateRuleIsNotValid(): void
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');

        self::assertFalse($rule->validate(['foo' => true, 'bar' => false]));
    }

    /**
     * @test
     */
    public function shouldValidateWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertTrue($rule->validate(['foo' => 42, 'bar' => 42]));
    }

    /**
     * @test
     */
    public function shouldValidateWhenDefinedValuesDoesNotMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');

        self::assertFalse($rule->validate(['foo' => 43, 'bar' => 42]));
    }

    /**
     * @doesNotPerformAssertions
     *
     * @test
     */
    public function shouldAssertWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->assert(['foo' => 42, 'bar' => 42]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\AllOfException
     * @expectedExceptionMessage All of the required rules must pass for foo
     *
     * @test
     */
    public function shouldAssertWhenDefinedValuesDoesNotMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyValueException
     * @expectedExceptionMessage "bar" must be valid to validate "foo"
     *
     * @test
     */
    public function shouldNotAssertWhenRuleIsNotValid(): void
    {
        $rule = new KeyValue('foo', 'probably_not_a_rule', 'bar');
        $rule->assert(['foo' => 43, 'bar' => 42]);
    }

    /**
     * @doesNotPerformAssertions
     *
     * @test
     */
    public function shouldCheckWhenDefinedValuesMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->check(['foo' => 42, 'bar' => 42]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EqualsException
     * @expectedExceptionMessage foo must equal "bar"
     *
     * @test
     */
    public function shouldCheckWhenDefinedValuesDoesNotMatch(): void
    {
        $rule = new KeyValue('foo', 'equals', 'bar');
        $rule->check(['foo' => 43, 'bar' => 42]);
    }
}
