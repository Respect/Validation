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
 * @covers Respect\Validation\Rules\Ip
 * @covers Respect\Validation\Exceptions\IpException
 */
class IpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForIp
     */
    public function testValidIpsShouldReturnTrue($input, $options = null)
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
    public function testInvalidIpsShouldThrowIpException($input, $options = null)
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
        return [
            ['127.0.0.1'],
        ];
    }

    public function providerForIpBetweenRange()
    {
        return [
            ['127.0.0.1', '127.*'],
            ['127.0.0.1', '127.0.*'],
            ['127.0.0.1', '127.0.0.*'],
            ['192.168.2.6', '192.168.*.6'],
            ['192.168.2.6', '192.*.2.6'],
            ['10.168.2.6', '*.168.2.6'],
            ['192.168.2.6', '192.168.*.*'],
            ['192.10.2.6', '192.*.*.*'],
            ['192.168.255.156', '*'],
            ['192.168.255.156', '*.*.*.*'],
            ['127.0.0.1', '127.0.0.0-127.0.0.255'],
            ['192.168.2.6', '192.168.0.0-192.168.255.255'],
            ['192.10.2.6', '192.0.0.0-192.255.255.255'],
            ['192.168.255.156', '0.0.0.0-255.255.255.255'],
            ['220.78.173.2', '220.78.168/21'],
            ['220.78.173.2', '220.78.168.0/21'],
            ['220.78.173.2', '220.78.168.0/255.255.248.0'],
        ];
    }

    public function providerForNotIp()
    {
        return [
            [''],
            [null],
            ['j'],
            [' '],
            ['Foo'],
            ['192.168.0.1', FILTER_FLAG_NO_PRIV_RANGE],
        ];
    }

    public function providerForIpOutsideRange()
    {
        return [
            ['127.0.0.1', '127.0.1.*'],
            ['192.168.2.6', '192.163.*.*'],
            ['192.10.2.6', '193.*.*.*'],
            ['127.0.0.1', '127.0.1.0-127.0.1.255'],
            ['192.168.2.6', '192.163.0.0-192.163.255.255'],
            ['192.10.2.6', '193.168.0.0-193.255.255.255'],
            ['220.78.176.1', '220.78.168/21'],
            ['220.78.176.2', '220.78.168.0/21'],
            ['220.78.176.3', '220.78.168.0/255.255.248.0'],
        ];
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
        return [
            ['192.168'],
            ['asd'],
            ['192.168.0.0-192.168.0.256'],
            ['192.168.0.0-192.168.0.1/4'],
            ['192.168.0/1'],
            ['192.168.2.0/256.256.256.256'],
            ['192.168.2.0/8.256.256.256'],
        ];
    }
}
