<?php

namespace Respect\Validation\Exceptions;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $e = ValidationException::create(new \stdClass, 'bar', array(),
                new \stdClass);
        $this->assertEquals(array('stdClass', 'bar', array(), new \stdClass),
            $e->getParams());
        $this->assertEquals('validation', $e->getId());
    }

    public function testConfigure()
    {
        $e = new ValidationException;
        $e->configure(new \stdClass, 'bar', array(), new \stdClass);
        $this->assertEquals(
            array('stdClass', 'bar', array(), new \stdClass), $e->getParams()
        );
        $this->assertEquals('validation', $e->getId());
    }

    public function testGetRelatedByName()
    {
        $a = new ValidationException;
        $a1 = new ValidationException;
        $a2 = new ValidationException;
        $a11 = new ValidationException;
        $a21 = new ValidationException;

        $a->setId('foo');
        $a1->setId('bar1');
        $a2->setId('bar2');
        $a11->setId('baz1');
        $a21->setId('baz2');

        $a1->addRelated($a11);
        $a2->addRelated($a21);
        $a->addRelated($a1);
        $a->addRelated($a2);

        $this->assertEquals($a1, $a->findRelated('bar1'));
        $this->assertEquals($a11, $a->findRelated('bar1', 'baz1'));
        $this->assertEquals($a2, $a->findRelated('bar2'));
        $this->assertEquals($a21, $a->findRelated('bar2', 'baz2'));
        $this->assertEquals(false, $a->findRelated('zzz', 'xxx'));
        $this->assertEquals(false, $a->findRelated('bar1', 'xx'));
    }

    public function testGetMainMessage()
    {
        $e = ValidationException::create('foo');
        $e->setTemplate('Validation baz %s');
        $this->assertEquals('Validation baz foo', $e->getMainMessage());
        $this->assertEquals($e->getMainMessage(), (string) $e);
    }

}