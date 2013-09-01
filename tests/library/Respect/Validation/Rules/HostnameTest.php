<?php
namespace Respect\Validation\Rules;

class HostnameTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Hostname();
    }

    /**
     * @dataProvider providerForHostname
     *
     */
    public function testValidHostnamesShouldReturnTrue($input, $tldcheck=true)
    {
        if($tldcheck === false) {
            $this->object->skipTldCheck();
        }
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
        $this->object->skipTldCheck(false);
    }

    /**
     * @dataProvider providerForNotHostname
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotHostname($input, $tldcheck=true)
    {
        if($tldcheck === false) {
            $this->object->skipTldCheck();
        }
        $this->assertFalse($this->object->check($input));
        $this->object->skipTldCheck(false);
    }

    /**
     * @dataProvider providerForNotHostname
     * @expectedException Respect\Validation\Exceptions\HostnameException
     */
    public function testNotDomainCheck($input, $tldcheck=true)
    {
        if($tldcheck === false) {
            $this->object->skipTldCheck();
        }
        $this->assertFalse($this->object->assert($input));
        $this->object->skipTldCheck(false);
    }

    public function providerForHostname()
    {
        return array(
            array(''),
            array('domain.local', false),
            array('example.com'),
            array('example-hyphen.com')
        );
    }

    public function providerForNotHostname()
    {
        return array(
            array(null),
            array('domain.local'),
            array('example.srv-'),
            array('example--invalid.com'),
            array('-example-invalid.com'),
            array('1.2.3.256'),
            array('1.2.3.4'),
            array('8.8.8.8')
        );
    }
}

