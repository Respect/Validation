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
 * @covers \Respect\Validation\Rules\BoolType
 * @covers \Respect\Validation\Exceptions\BoolTypeException
 */
class BoolTypeTest extends TestCase
{
    public function testBooleanValuesONLYShouldReturnTrue(): void
    {
        $validator = new BoolType();
        self::assertTrue($validator->__invoke(true));
        self::assertTrue($validator->__invoke(false));
        $validator->assert(true);
        $validator->assert(false);
        $validator->check(true);
        $validator->check(false);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\BoolTypeException
     */
    public function testInvalidBooleanShouldRaiseException(): void
    {
        $validator = new BoolType();
        $validator->check('foo');
    }

    public function testInvalidBooleanValuesShouldReturnFalse(): void
    {
        $validator = new BoolType();
        self::assertFalse($validator->__invoke(''));
        self::assertFalse($validator->__invoke('foo'));
        self::assertFalse($validator->__invoke(123123));
        self::assertFalse($validator->__invoke(new \stdClass()));
        self::assertFalse($validator->__invoke([]));
        self::assertFalse($validator->__invoke(1));
        self::assertFalse($validator->__invoke(0));
        self::assertFalse($validator->__invoke(null));
    }
}
