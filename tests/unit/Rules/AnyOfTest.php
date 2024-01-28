<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\AnyOfException;
use Respect\Validation\Exceptions\XdigitException;
use Respect\Validation\Test\TestCase;

#[Group('rule')]
#[CoversClass(AnyOfException::class)]
#[CoversClass(AnyOf::class)]
final class AnyOfTest extends TestCase
{
    #[Test]
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

    #[Test]
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

    #[Test]
    public function invalidCheck(): void
    {
        $o = new AnyOf(new Xdigit(), new Alnum());
        self::assertFalse($o->validate(-10));

        $this->expectException(XdigitException::class);
        $o->check(-10);
    }
}
