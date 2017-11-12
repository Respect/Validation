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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Callback
 * @covers \Respect\Validation\Exceptions\CallbackException
 */
class CallbackTest extends TestCase
{
    private $truthy, $falsy;

    public function setUp()
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

    public function testShouldBeAbleToDefineLatestArgumentsOnConstructor()
    {
        $rule = new Callback('is_a', 'stdClass');

        self::assertTrue($rule->validate(new \stdClass()));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseForEmptyString()
    {
        $this->falsy->assert('');
    }

    public function testCallbackValidatorShouldReturnTrueIfCallbackReturnsTrue()
    {
        self::assertTrue($this->truthy->assert('wpoiur'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testCallbackValidatorShouldReturnFalseIfCallbackReturnsFalse()
    {
        self::assertTrue($this->falsy->assert('w poiur'));
    }

    public function testCallbackValidatorShouldAcceptArrayCallbackDefinitions()
    {
        $v = new Callback([$this, 'thisIsASampleCallbackUsedInsideThisTest']);
        self::assertTrue($v->assert('test'));
    }

    public function testCallbackValidatorShouldAcceptFunctionNamesAsString()
    {
        $v = new Callback('is_string');
        self::assertTrue($v->assert('test'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidCallbacksShouldRaiseComponentExceptionUponInstantiation()
    {
        $v = new Callback(new \stdClass());
        self::assertTrue($v->assert('w poiur'));
    }
}
