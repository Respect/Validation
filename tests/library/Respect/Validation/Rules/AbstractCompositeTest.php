<?php

namespace Respect\Validation;

class AbstractCompositeTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass(
                'Respect\Validation\Rules\AbstractComposite'
        );
    }

    protected function tearDown()
    {
        unset($this->object);
    }

    public function testAddExistentValidator()
    {
        $validator = new Rules\Callback(function() {
                    return true;
                });
        $this->object->addRule($validator);
        $this->assertContains($validator, $this->object->getRules());
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testAddNonValidator()
    {
        $this->object->addRule(new \stdClass);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testAddNonValidator2()
    {
        $this->object->addRule('CompletelyNonExistant');
    }

    public function testBuildValidators()
    {
        $this->object->addRules(array(
            'noWhitespace', 'StringNotEmpty', 'Alnum' => array('__')
        ));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testBuildValidatorsArrayParams()
    {
        $this->object->addRules(array(
            'noWhitespace', 'Alnum' => 'aiods'
        ));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testBuildValidatorsNonExistant()
    {
        $this->object->addRules(array(
            'noWhitespace', 'FooBaz'
        ));
    }

}