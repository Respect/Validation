<?php
namespace Respect\Validation\Rules;

use \Respect\Validation\Validator as v;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {

    }

    /**
     * @dataProvider providerForBase
     *
     */
    public function testBase($base, $input)
    {
        $object = new Base($base);
        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->check($input));
        $this->assertTrue($object->assert($input));
    }

    /**
     * @dataProvider providerForBase
     *
     */
    public function testBaseShortcut($base, $input)
    {
        $method = 'base' . $base;
        $object = v::$method();

        $this->assertTrue($object->__invoke($input));
        $this->assertTrue($object->check($input));
        $this->assertTrue($object->assert($input));
    }

    /**
     * @dataProvider providerForInvalidBase
     *
     */
    public function testInvalidBase($base, $input)
    {
        $object = new Base($base);
        $this->assertFalse($object->__invoke($input));
    }

    /**
     * @dataProvider providerForInvalidBase
     *
     */
    public function testInvalidBaseShortcut($base, $input)
    {
        $method = 'base' . $base;
        $object = v::$method();
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
     *
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
        return array(
            array(2, ''),
            array(3, ''),
            array(8, ''),
            array(16, ''),
            array(20, ''),
            array(50, ''),
            array(62, ''),
            array(2, '011010001'),
            array(3, '0120122001'),
            array(8, '01234567520'),
            array(16, '012a34f5675c20d'),
            array(20, '012ah34f5675hic20dj'),
            array(50, '012ah34f56A75FGhic20dj'),
            array(62, 'Z01xSsg5675hic20dj'),
        );
    }

    public function providerForInvalidBase()
    {
        return array(
            array(2, '01210103001'),
            array(3, '0120125f2001'),
            array(8, '01234dfZ567520'),
            array(16, '012aXS34f5675c20d'),
            array(20, '012ahZX34f5675hic20dj'),
            array(50, '012ahGZ34f56A75FGhic20dj'),
            array(61, 'Z01xSsg5675hic20dj'),
        );
    }

    public function providerForCustomBase()
    {
        return array(
            array(2, 'xy', 'xyyxyxxy'),
            array(3, 'pfg', 'gfpffp')
        );
    }

    public function providerForExceptionBase()
    {
        return array(
            array(63, '01210103001'),
            array(125, '0120125f2001')
        );
    }
}

