<?php

namespace Respect\Validation\Rules;

class ZendTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!class_exists('Zend\Version')) {
            $this->markTestSkipped('No ZendFramework installed');
        }
    }

    public function testSimpleOk()
    {
        $v = new Zend('alnum');
        $this->assertTrue($v->assert('wp2oiur'));
    }

    public function testNamespaceOk()
    {
        $v = new Zend('sitemap_lastmod');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testSimpleNot()
    {
        $v = new Zend('alnum');
        $this->assertTrue($v->assert('#$%#$%'));
    }

    public function testParamsOk()
    {
        $v = new Zend('stringLength', array('min' => 10, 'max' => 25));
        $this->assertTrue($v->assert('owurhfojgboerjng'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testParamsNot()
    {
        $v = new Zend('stringLength', array('min' => 10, 'max' => 25));
        $this->assertTrue($v->assert('aw'));
    }

}