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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\OneOf
 * @covers \Respect\Validation\Exceptions\OneOfException
 */
class OneOfTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $valid1 = new Callback(function () {
            return false;
        });
        $valid2 = new Callback(function () {
            return true;
        });
        $valid3 = new Callback(function () {
            return false;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);

        $this->assertTrue($rule->validate('any'));
        $this->assertTrue($rule->assert('any'));
        $this->assertTrue($rule->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testEmptyChain()
    {
        $rule = new OneOf();

        $this->assertFalse($rule->validate('any'));
        $this->assertFalse($rule->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalid()
    {
        $valid1 = new Callback(function () {
            return false;
        });
        $valid2 = new Callback(function () {
            return false;
        });
        $valid3 = new Callback(function () {
            return false;
        });
        $rule = new OneOf($valid1, $valid2, $valid3);
        $this->assertFalse($rule->validate('any'));
        $this->assertFalse($rule->assert('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalidMultipleAssert()
    {
        $valid1 = new Callback(function () {
            return true;
        });
        $valid2 = new Callback(function () {
            return true;
        });
        $valid3 = new Callback(function () {
            return false;
        });
        $rule = new OneOf($valid1, $valid2, $valid3);
        $this->assertFalse($rule->validate('any'));

        $rule->assert('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testInvalidMultipleCheck()
    {
        $valid1 = new Callback(function () {
            return true;
        });
        $valid2 = new Callback(function () {
            return true;
        });
        $valid3 = new Callback(function () {
            return false;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);
        $this->assertFalse($rule->validate('any'));

        $rule->check('any');
    }
    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalidMultipleCheckAllValid()
    {
        $valid1 = new Callback(function () {
            return true;
        });
        $valid2 = new Callback(function () {
            return true;
        });
        $valid3 = new Callback(function () {
            return true;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);
        $this->assertFalse($rule->validate('any'));

        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     */
    public function testInvalidCheck()
    {
        $rule = new OneOf(new Xdigit(), new Alnum());
        $this->assertFalse($rule->validate(-10));

        $rule->check(-10);
    }
}
