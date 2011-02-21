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
    public function testDomain($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException Respect\Validation\Exceptions\DomainException
     */
    public function testNotDomain($input)
    {
        $this->assertTrue($this->object->assert($input));
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
            array('1.2.3.256'),
        );
    }

}