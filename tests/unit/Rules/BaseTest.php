<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Base
 * @covers Respect\Validation\Exceptions\BaseException
 */
class BaseTest extends TestCase
{
    protected $object;

    /**
     * @dataProvider providerForBase
     */
    public function testBase($base, $input)
    {
        $object = new Base($base);
        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->check($input));
        $this->assertTrue($object->assert($input));
    }

    /**
     * @dataProvider providerForInvalidBase
     */
    public function testInvalidBase($base, $input)
    {
        $object = new Base($base);
        $this->assertFalse($object->__invoke($input));
    }

    /**
     * @dataProvider providerForExceptionBase
     * @expectedException Respect\Validation\Exceptions\BaseException
     */
    public function testExceptionBase($base, $input)
    {
        $object = new Base($base);
        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->assert($input));
    }

    /**
     * @dataProvider providerForCustomBase
     */
    public function testCustomBase($base, $custom, $input)
    {
        $object = new Base($base, $custom);
        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->check($input));
        $this->assertTrue($object->assert($input));
    }

    public function providerForBase()
    {
        return [
            [2, '011010001'],
            [3, '0120122001'],
            [8, '01234567520'],
            [16, '012a34f5675c20d'],
            [20, '012ah34f5675hic20dj'],
            [50, '012ah34f56A75FGhic20dj'],
            [62, 'Z01xSsg5675hic20dj'],
        ];
    }

    public function providerForInvalidBase()
    {
        return [
            [2, ''],
            [3, ''],
            [8, ''],
            [16, ''],
            [20, ''],
            [50, ''],
            [62, ''],
            [2, '01210103001'],
            [3, '0120125f2001'],
            [8, '01234dfZ567520'],
            [16, '012aXS34f5675c20d'],
            [20, '012ahZX34f5675hic20dj'],
            [50, '012ahGZ34f56A75FGhic20dj'],
            [61, 'Z01xSsg5675hic20dj'],
        ];
    }

    public function providerForCustomBase()
    {
        return [
            [2, 'xy', 'xyyxyxxy'],
            [3, 'pfg', 'gfpffp'],
        ];
    }

    public function providerForExceptionBase()
    {
        return [
            [63, '01210103001'],
            [125, '0120125f2001'],
        ];
    }
}
