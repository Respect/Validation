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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\OneOfException
 * @covers \Respect\Validation\Rules\OneOf
 *
 * @author Bradyn Poulsen <bradyn@bradynpoulsen.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class OneOfTest extends TestCase
{
    /**
     * @test
     */
    public function valid(): void
    {
        $valid1 = new Callback(static function () {
            return false;
        });
        $valid2 = new Callback(static function () {
            return true;
        });
        $valid3 = new Callback(static function () {
            return false;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);

        self::assertTrue($rule->validate('any'));
        $rule->assert('any');
        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     *
     * @test
     */
    public function emptyChain(): void
    {
        $rule = new OneOf();

        self::assertFalse($rule->validate('any'));
        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\OneOfException
     *
     * @test
     */
    public function invalid(): void
    {
        $valid1 = new Callback(static function () {
            return false;
        });
        $valid2 = new Callback(static function () {
            return false;
        });
        $valid3 = new Callback(static function () {
            return false;
        });
        $rule = new OneOf($valid1, $valid2, $valid3);
        self::assertFalse($rule->validate('any'));
        $rule->assert('any');
    }

    /**
     * @test
     */
    public function invalidMultipleAssert(): void
    {
        $valid1 = new Callback(static function () {
            return true;
        });
        $valid2 = new Callback(static function () {
            return true;
        });
        $valid3 = new Callback(static function () {
            return false;
        });
        $rule = new OneOf($valid1, $valid2, $valid3);
        self::assertTrue($rule->validate('any'));

        $rule->assert('any');
    }

    /**
     * @test
     */
    public function invalidMultipleCheck(): void
    {
        $valid1 = new Callback(static function () {
            return true;
        });
        $valid2 = new Callback(static function () {
            return true;
        });
        $valid3 = new Callback(static function () {
            return false;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);
        self::assertTrue($rule->validate('any'));

        $rule->check('any');
    }

    /**
     * @test
     */
    public function invalidMultipleCheckAllValid(): void
    {
        $valid1 = new Callback(static function () {
            return true;
        });
        $valid2 = new Callback(static function () {
            return true;
        });
        $valid3 = new Callback(static function () {
            return true;
        });

        $rule = new OneOf($valid1, $valid2, $valid3);
        self::assertTrue($rule->validate('any'));

        $rule->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     *
     * @test
     */
    public function invalidCheck(): void
    {
        $rule = new OneOf(new Xdigit(), new Alnum());
        self::assertFalse($rule->validate(-10));

        $rule->check(-10);
    }
}
