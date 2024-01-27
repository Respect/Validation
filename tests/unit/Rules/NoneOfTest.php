<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NoneOfException;
use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\NoneOfException
 * @covers \Respect\Validation\Rules\NoneOf
 */
final class NoneOfTest extends TestCase
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
            return false;
        });
        $valid3 = new Callback(static function () {
            return false;
        });
        $o = new NoneOf($valid1, $valid2, $valid3);
        self::assertTrue($o->validate('any'));
        $o->assert('any');
        $o->check('any');
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
            return true;
        });
        $o = new NoneOf($valid1, $valid2, $valid3);
        self::assertFalse($o->validate('any'));

        $this->expectException(NoneOfException::class);
        $o->assert('any');
    }
}
