<?php

namespace Respect\Validation\Rules;

class OddTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Twitter;
    }

    /**
     * @dataProvider providerForTwitter
     *
     */
    public function testTwitter($input)
    {
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotTwitter
     * @expectedException Respect\Validation\Exceptions\TwitterException
     */
    public function testNotTwitter($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }
    

    public function providerForNotTwitter()
    {
        return array(
            array(0, ''),
            array(null, ''),
            array(new \stdClass, ''),
            array(array(), ''),
            array('_', ''),
            array('', ''),
            array("\t", ''),
            array("\n", ''),
                        
        );
    }
    
}
