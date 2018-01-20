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
 * @covers \Respect\Validation\Rules\OneOf
 * @covers \Respect\Validation\Exceptions\OneOfException
 */
class OneOfTest extends TestCase
{
    public function testValid(): void
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

        self::assertTrue($rule->validate('any'));
        self::assertTrue($rule->assert('any'));
        self::assertTrue($rule->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testEmptyChain(): void
    {
        $rule = new OneOf();

        self::assertFalse($rule->validate('any'));
        self::assertFalse($rule->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalid(): void
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
        self::assertFalse($rule->validate('any'));
        self::assertFalse($rule->assert('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalidMultipleAssert(): void
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
        self::assertFalse($rule->validate('any'));

        $rule->assert('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testInvalidMultipleCheck(): void
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
        self::assertFalse($rule->validate('any'));

        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     */
    public function testInvalidMultipleCheckAllValid(): void
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
        self::assertFalse($rule->validate('any'));

        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     */
    public function testInvalidCheck(): void
    {
        $rule = new OneOf(new Xdigit(), new Alnum());
        self::assertFalse($rule->validate(-10));

        $rule->check(-10);
    }
}
