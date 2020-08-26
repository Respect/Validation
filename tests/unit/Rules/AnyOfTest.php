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

use Respect\Validation\Exceptions\AnyOfException;
use Respect\Validation\Exceptions\XdigitException;
use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\AnyOfException
 * @covers \Respect\Validation\Rules\AnyOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AnyOfTest extends TestCase
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
        $o = new AnyOf($valid1, $valid2, $valid3);
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
            return false;
        });
        $o = new AnyOf($valid1, $valid2, $valid3);
        self::assertFalse($o->validate('any'));

        $this->expectException(AnyOfException::class);
        $o->assert('any');
    }

    /**
     * @test
     */
    public function invalidCheck(): void
    {
        $o = new AnyOf(new Xdigit(), new Alnum());
        self::assertFalse($o->validate(-10));

        $this->expectException(XdigitException::class);
        $o->check(-10);
    }
}
