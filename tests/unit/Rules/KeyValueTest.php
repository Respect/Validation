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
 * @group  rule
 * @covers \Respect\Validation\Exceptions\KeyValueException
 * @covers \Respect\Validation\Rules\KeyValue
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ian Nisbet <ian@glutenite.co.uk>
 */
final class KeyValueTest extends TestCase
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

        self::assertAttributeSame($comparedKey, 'comparedKey', $rule);
        self::assertAttributeSame($ruleName, 'ruleName', $rule);
        self::assertAttributeSame($baseKey, 'baseKey', $rule);
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
