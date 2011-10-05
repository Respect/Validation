<?php

namespace Respect\Validation\Rules;

class DomainTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Domain;
    }

    /**
     * @dataProvider providerForDomain
     *
     */
    public function test_valid_domains_should_return_true($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotDomain($input)
    {
        $this->assertFalse($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException Respect\Validation\Exceptions\DomainException
     */
    public function testNotDomainCheck($input)
    {
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForDomain()
    {
        return array(
            array('example.com'),
            array('example-hyphen.com'),
            array('1.2.3.4'),
        );
    }

    public function providerForNotDomain()
    {
        return array(
            array(null),
            array('domain.local'),
            array('example--invalid.com'),
            array('-example-invalid.com'),
            array('1.2.3.256'),
        );
    }

}