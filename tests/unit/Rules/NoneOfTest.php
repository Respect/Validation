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
 * @covers \Respect\Validation\Rules\NoneOf
 * @covers \Respect\Validation\Exceptions\NoneOfException
 */
class NoneOfTest extends TestCase
{
    public function testValid(): void
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
        self::assertTrue($o->assert('any'));
        self::assertTrue($o->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\NoneOfException
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
            return true;
        });
        $o = new NoneOf($valid1, $valid2, $valid3);
        self::assertFalse($o->validate('any'));
        self::assertFalse($o->assert('any'));
    }
}
