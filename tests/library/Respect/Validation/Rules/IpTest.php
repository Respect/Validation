<?php
namespace Respect\Validation\Rules;

class IpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForIp
     *
     */
    public function testValidIpsShouldReturnTrue($input, $options=null)
    {
        $ipValidator = new Ip($options);
        $this->assertTrue($ipValidator->__invoke($input));
        $this->assertTrue($ipValidator->assert($input));
        $this->assertTrue($ipValidator->check($input));
    }

    /**
     * @dataProvider providerForIpBetweenRange
     */
    public function testIpsBetweenRangeShouldReturnTrue($input, $networkRange)
    {
        $ipValidator = new Ip($networkRange);
        $this->assertTrue($ipValidator->__invoke($input));
        $this->assertTrue($ipValidator->assert($input));
        $this->assertTrue($ipValidator->check($input));
    }

    /**
     * @dataProvider providerForNotIp
     * @expectedException Respect\Validation\Exceptions\IpException
     */
    public function testInvalidIpsShouldThrowIpException($input, $options=null)
    {
        $ipValidator = new Ip($options);
        $this->assertFalse($ipValidator->__invoke($input));
        $this->assertFalse($ipValidator->assert($input));
    }

    /**
     * @dataProvider providerForIpOutsideRange
     * @expectedException Respect\Validation\Exceptions\IpException
     */
    public function testIpsOutsideRangeShouldReturnFalse($input, $networkRange)
    {
        $ipValidator = new Ip($networkRange);
        $this->assertFalse($ipValidator->__invoke($input));
        $this->assertFalse($ipValidator->assert($input));
    }

    public function providerForIp()
    {
        return array(
            array(''),
            array('127.0.0.1'),
        );
    }

    public function providerForIpBetweenRange()
    {
        return array(
            array('127.0.0.1', '127.*'),
            array('127.0.0.1', '127.0.*'),
            array('127.0.0.1', '127.0.0.*'),
            array('192.168.2.6', '192.168.*.6'),
            array('192.168.2.6', '192.*.2.6'),
            array('10.168.2.6', '*.168.2.6'),
            array('192.168.2.6', '192.168.*.*'),
            array('192.10.2.6', '192.*.*.*'),
            array('192.168.255.156', '*'),
            array('192.168.255.156', '*.*.*.*'),
            array('127.0.0.1', '127.0.0.0-127.0.0.255'),
            array('192.168.2.6', '192.168.0.0-192.168.255.255'),
            array('192.10.2.6', '192.0.0.0-192.255.255.255'),
            array('192.168.255.156', '0.0.0.0-255.255.255.255'),
            array('220.78.173.2', '220.78.168/21'),
            array('220.78.173.2', '220.78.168.0/21'),
            array('220.78.173.2', '220.78.168.0/255.255.248.0'),
        );
    }

    public function providerForNotIp()
    {
        return array(
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array('192.168.0.1', FILTER_FLAG_NO_PRIV_RANGE),
        );
    }

    public function providerForIpOutsideRange()
    {
        return array(
            array('127.0.0.1', '127.0.1.*'),
            array('192.168.2.6', '192.163.*.*'),
            array('192.10.2.6', '193.*.*.*'),
            array('127.0.0.1', '127.0.1.0-127.0.1.255'),
            array('192.168.2.6', '192.163.0.0-192.163.255.255'),
            array('192.10.2.6', '193.168.0.0-193.255.255.255'),
            array('220.78.176.1', '220.78.168/21'),
            array('220.78.176.2', '220.78.168.0/21'),
            array('220.78.176.3', '220.78.168.0/255.255.248.0'),
        );
    }

    /**
     * @dataProvider providerForInvalidRanges
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidRangeShouldRaiseException($range)
    {
        $o = new Ip($range);
    }

    public function providerForInvalidRanges()
    {
        return array(
            array('192.168'),
            array('asd'),
            array('192.168.0.0-192.168.0.256'),
            array('192.168.0.0-192.168.0.1/4'),
            array('192.168.0/1'),
            array('192.168.2.0/256.256.256.256'),
            array('192.168.2.0/8.256.256.256'),
        );
    }
}

