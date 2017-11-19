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
 * @covers \Respect\Validation\Rules\Callback
 * @covers \Respect\Validation\Exceptions\CallbackException
 */
class CallbackTest extends TestCase
{
    private $truthy;
    private $falsy;

    public function setUp(): void
    {
        $this->truthy = new Callback(function () {
            return true;
        });
        $this->falsy = new Callback(function () {
            return false;
        });
    }

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return true;
    }

    public function testShouldBeAbleToDefineLatestArgumentsOnConstructor(): void
    {
        $rule = new Callback('is_a', 'stdClass');

        self::assertTrue($rule->validate(new \stdClass()));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseForEmptyString(): void
    {
        $this->falsy->assert('');
    }

    public function testCallbackValidatorShouldReturnTrueIfCallbackReturnsTrue(): void
    {
        self::assertTrue($this->truthy->assert('wpoiur'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseIfCallbackReturnsFalse(): void
    {
        self::assertTrue($this->falsy->assert('w poiur'));
    }

    public function testCallbackValidatorShouldAcceptArrayCallbackDefinitions(): void
    {
        $v = new Callback([$this, 'thisIsASampleCallbackUsedInsideThisTest']);
        self::assertTrue($v->assert('test'));
    }

    public function testCallbackValidatorShouldAcceptFunctionNamesAsString(): void
    {
        $v = new Callback('is_string');
        self::assertTrue($v->assert('test'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidCallbacksShouldRaiseComponentExceptionUponInstantiation(): void
    {
        $v = new Callback(new \stdClass());
        self::assertTrue($v->assert('w poiur'));
    }
}
