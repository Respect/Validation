<?php

namespace Respect\Validation\Rules;

class AbstractRelatedTest extends \PHPUnit_Framework_TestCase
{

    protected function createMock($referenceName, $validator, $mandatory,
        $hasReference)
    {
        $mock = $this->getMockForAbstractClass(
                'Respect\Validation\Rules\AbstractRelated',
                array($referenceName, $validator, $mandatory)
        );
        $mock
            ->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue($hasReference));
        $mock
            ->expects($this->any())
            ->method('getReferenceValue')
            ->will($this->returnValue($referenceName));
        return $mock;
    }

    public function testValidateMandatoryTrue()
    {
        $mock = $this->createMock('whatever', new NotEmpty, true, false);
        $this->assertFalse($mock->validate('whatever'));
    }

    public function testValidateMandatoryFalse()
    {
        $mock = $this->createMock('whatever', new NotEmpty, false, false);
        $this->assertTrue($mock->validate('whatever'));
    }

    public function testValidateHasReference()
    {
        $mock = $this->createMock(
                '', new NotEmpty, false, false
        );
        $this->assertFalse($mock->validate('bla'));

        $mock = $this->createMock(
                'this is not empty', new NotEmpty, false, false
        );
        $this->assertTrue($mock->validate('bla'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAssert()
    {
        $mock = $this->createMock(
                '', new NotEmpty, false, false
        );
        //overriding exception cause mocks cant handle createException properly
        $mock->setException(new \InvalidArgumentException(''));
        $this->assertFalse($mock->assert('bla'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAssertHasReference()
    {
        $mock = $this->createMock(
                '', null, true, false
        );
        //overriding exception cause mocks cant handle createException properly
        $mock->setException(new \InvalidArgumentException(''));
        $this->assertFalse($mock->assert('bla'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testCheck()
    {
        $mock = $this->createMock(
                '', new NotEmpty, true, true
        );
        $this->assertFalse($mock->check('bla'));
    }

}