<?php

namespace Respect\Validation\Rules;

class IpTest extends \PHPUnit_Framework_TestCase
{

    protected $ipValidator;

    protected function setUp()
    {
        $this->ipValidator = new Ip;
    }

    /**
     * @dataProvider providerForIp
     *
     */
    public function test_valid_ips_should_return_True($input, $options=null)
    {
        $this->ipValidator->ipOptions = $options;
        $this->assertTrue($this->ipValidator->validate($input));
        $this->assertTrue($this->ipValidator->assert($input));
        $this->assertTrue($this->ipValidator->check($input));
    }

    /**
     * @dataProvider providerForNotIp
     * @expectedException Respect\Validation\Exceptions\IpException
     */
    public function test_invalid_ips_should_throw_IpException($input, $options=null)
    {
        $this->ipValidator->ipOptions = $options;
        $this->assertFalse($this->ipValidator->validate($input));
        $this->assertFalse($this->ipValidator->assert($input));
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
