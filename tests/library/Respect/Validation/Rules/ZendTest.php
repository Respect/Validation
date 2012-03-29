<?php

namespace Respect\Validation\Rules;

class ZendTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!class_exists('Zend\Validator\AbstractValidator')) {
            $this->markTestSkipped('No ZendFramework installed');
        }
    }

    public function testSimpleOk()
    {
        $v = new Zend('Alnum');
        $this->assertTrue($v->validate('wp2oiur'));
        $this->assertTrue($v->assert('wp2oiur'));
    }

    public function testFullNsOk()
    {
        $v = new Zend('Zend\\Validator\\Alnum');
        $this->assertTrue($v->validate('wp2oiur'));
        $this->assertTrue($v->assert('wp2oiur'));
    }

    public function testExtended()
    {
        $v = new Zend(new MyValidator);
        $this->assertTrue($v->validate('wp2oiur'));
        $this->assertTrue($v->assert('wp2oiur'));
    }

    public function testInstanceOk()
    {
        $v = new Zend(new \Zend\Validator\Alnum);
        $this->assertTrue($v->validate('wp2oiur'));
        $this->assertTrue($v->assert('wp2oiur'));
    }

    public function testNamespaceOk()
    {
        $v = new Zend('Sitemap\\Lastmod');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ZendException
     */
    public function testSimpleNot()
    {
        $v = new Zend('alnum');
        $this->assertFalse($v->validate('#$%#$%'));
        $this->assertFalse($v->assert('#$%#$%'));
    }

    public function testParamsOk()
    {
        $v = new Zend('StringLength', array('min' => 10, 'max' => 25));
        $this->assertTrue($v->assert('owurhfojgboerjng'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ZendException
     */
    public function testParamsNot()
    {
        $v = new Zend('StringLength', array('min' => 10, 'max' => 25));
        $this->assertFalse($v->assert('aw'));
    }

}

if (class_exists('Zend\Validator\AbstractValidator')) {
    class MyValidator extends \Zend\Validator\Alnum
    {
    }
}