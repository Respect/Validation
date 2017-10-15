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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Base
 * @covers \Respect\Validation\Exceptions\BaseException
 */
class Base64Test extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * @dataProvider providerForBase
     */
    public function testBase($input)
    {
        $object = new Base64();
        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->check($input));
        $this->assertTrue($object->assert($input));
    }

    /**
     * @dataProvider providerForInvalidBase
     */
    public function testInvalidBase($input)
    {
        $object = new Base64();
        $this->assertFalse($object->__invoke($input));
    }

    /**
     * @dataProvider providerForInvalidBase
     * @expectedException \Respect\Validation\Exceptions\Base64Exception
     */
    public function testExceptionBase($input)
    {
        $object = new Base64();
        $this->assertFalse($object->assert($input));
    }

    public function providerForBase()
    {
        return [
            [base64_encode('respect')],
        ];
    }

    public function providerForInvalidBase()
    {
        return [
            [''],
            ['hello!'],
        ];
    }
}
