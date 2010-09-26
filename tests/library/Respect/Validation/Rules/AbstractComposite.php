<?php

namespace Respect\Validation;

class AbstractCompositeTest extends ValidatorTestCase
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

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testAddExistentValidator($validator)
    {
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
        if (!class_exists('Respect\Validation\FooFreak', false)) {
            eval("
                namespace Respect\Validation\Rules; 
                class FooFreak{}
                ");
        }
        $this->object->addRule('FooFreak');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testAddValidatorsMessages($a, $b)
    {
        $messagesA = $a->getMessages();
        $messagesB = $b->getMessages();
        $this->object->addRules(func_get_args());
        $messagesObject = $this->object->getMessages();
        foreach ($messagesA as $m) {
            $this->assertContains($m, $messagesObject);
        }
        foreach ($messagesB as $m) {
            $this->assertContains($m, $messagesObject);
        }
    }

    public function testBuildValidators()
    {
        $this->providerForMockImpossibleValidators();
        $this->object->addRules(array(
            'FooBar', 'FooBaz', 'FooBat' => array(1, 2, 3)
        ));
        $this->assertValidatorPresence($this->object, 'FooBar', 'FooBaz',
            'FooBat');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testBuildValidatorsInvalid()
    {
        $this->providerForMockImpossibleValidators();
        $this->object->addRules(array(
            'FooBar', 'FooBaz', 'FooBat' => 'balkbal'
        ));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testSetMessages($a, $b)
    {
        $messagesA = $a->getMessages();
        $messagesB = $b->getMessages();
        $this->object->addRules(func_get_args());
        $this->object->setMessages(
            array_map('strrev', $this->object->getMessages())
        );
        $messagesObject = $this->object->getMessages();
        foreach ($messagesA as $m) {
            $this->assertContains(strrev($m), $messagesObject);
        }
        foreach ($messagesB as $m) {
            $this->assertContains(strrev($m), $messagesObject);
        }
    }

}