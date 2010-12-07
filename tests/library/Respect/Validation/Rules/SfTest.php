<?php

namespace Respect\Validation\Rules;

class SfTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        if ( ! class_exists('Symfony\Component\Validator\ConstraintViolation') ) {
            $this->markTestSkipped('No Symfony installed');
        }
    }

    public function testParamsOk()
    {
        $v = new Sf('minLength', array('limit' => 3));
        $this->assertTrue($v->assert('wp2oiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\SfException
     */
    public function testParamsNot()
    {
        $v = new Sf('minLength', array('limit' => 3));
        $this->assertTrue($v->assert('a'));
    }

}