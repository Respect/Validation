<?php

namespace Respect\Validation\Rules;

class IpTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Ip;
    }

    /**
     * @dataProvider providerForIp
     *
     */
    public function testIp($input, $options=null)
    {
        $this->object->ipOptions = $options;
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotIp
     * @expectedException Respect\Validation\Exceptions\IpException
     */
    public function testNotIp($input, $options=null)
    {
        $this->object->ipOptions = $options;
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForIp()
    {
        return array(
            array('127.0.0.1'),
        );
    }

    public function providerForNotIp()
    {
        return array(
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array(''),
            array('192.168.0.1', FILTER_FLAG_NO_PRIV_RANGE),
        );
    }

}
