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
 * @covers \Respect\Validation\Rules\AnyOf
 * @covers \Respect\Validation\Exceptions\AnyOfException
 */
class AnyOfTest extends TestCase
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
        $o = new AnyOf($valid1, $valid2, $valid3);
        self::assertTrue($o->validate('any'));
        self::assertTrue($o->assert('any'));
        self::assertTrue($o->check('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\AnyOfException
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
        $o = new AnyOf($valid1, $valid2, $valid3);
        self::assertFalse($o->validate('any'));
        self::assertFalse($o->assert('any'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\XdigitException
     */
    public function testInvalidCheck(): void
    {
        $o = new AnyOf(new Xdigit(), new Alnum());
        self::assertFalse($o->validate(-10));
        self::assertFalse($o->check(-10));
    }
}
