<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\OneOfException;
use Respect\Validation\Exceptions\XdigitException;
use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\OneOfException
 * @covers \Respect\Validation\Rules\OneOf
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
     * @test
     */
    public function emptyChain(): void
    {
        $rule = new OneOf();

        self::assertFalse($rule->validate('any'));

        $this->expectException(OneOfException::class);

        $rule->check('any');
    }

    /**
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

        $this->expectException(OneOfException::class);
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
        self::assertFalse($rule->validate('any'));

        $this->expectException(OneOfException::class);
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
        self::assertFalse($rule->validate('any'));

        $this->expectException(CallbackException::class);
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
        self::assertFalse($rule->validate('any'));

        $this->expectException(OneOfException::class);
        $rule->check('any');
    }

    /**
     * @test
     */
    public function invalidCheck(): void
    {
        $rule = new OneOf(new Xdigit(), new Alnum());
        self::assertFalse($rule->validate(-10));

        $this->expectException(XdigitException::class);
        $rule->check(-10);
    }
}
