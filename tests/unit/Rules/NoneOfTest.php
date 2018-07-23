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
 * @covers \Respect\Validation\Exceptions\NoneOfException
 * @covers \Respect\Validation\Rules\NoneOf
 */
class NoneOfTest extends TestCase
{
    /**
     * @test
     */
    public function valid(): void
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
        $o = new NoneOf($valid1, $valid2, $valid3);
        self::assertTrue($o->validate('any'));
        $o->assert('any');
        $o->check('any');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\NoneOfException
     *
     * @test
     */
    public function invalid(): void
    {
        $valid1 = new Callback(function () {
            return false;
        });
        $valid2 = new Callback(function () {
            return false;
        });
        $valid3 = new Callback(function () {
            return true;
        });
        $o = new NoneOf($valid1, $valid2, $valid3);
        self::assertFalse($o->validate('any'));
        $o->assert('any');
    }
}
