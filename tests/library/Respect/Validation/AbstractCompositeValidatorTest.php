<?php

namespace Respect\Validation;

class AbstractCompositeValidatorTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass(
                'Respect\Validation\AbstractCompositeValidator'
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
        $this->object->addValidator($validator);
        $this->assertContains($validator, $this->object->getValidators());
    }

    /**
     * @expectedException Respect\Validation\ComponentException
     */
    public function testAddNonValidator()
    {
        $this->object->addValidator(new \stdClass);
    }

    /**
     * @expectedException Respect\Validation\ComponentException
     */
    public function testAddNonValidator2()
    {
        if (!class_exists('Respect\Validation\Foo\Freak', false)) {
            eval("
                namespace Respect\Validation\Foo; 
                class Freak{}
                ");
        }
        $this->object->addValidator('Foo\Freak');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testAddValidatorsMessages($a, $b)
    {
        $messagesA = $a->getMessages();
        $messagesB = $b->getMessages();
        $this->object->addValidators(func_get_args());
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
        $this->object->addValidators(array(
            'Foo\Bar', 'Foo\Baz', 'Foo\Bat' => array(1, 2, 3)
        ));
        $this->assertValidatorPresence($this->object, 'Bar', 'Baz', 'Bat');
    }

    /**
     * @expectedException Respect\Validation\ComponentException
     */
    public function testBuildValidatorsInvalid()
    {
        $this->providerForMockImpossibleValidators();
        $this->object->addValidators(array(
            'Foo\Bar', 'Foo\Baz', 'Foo\Bat' => 'balkbal'
        ));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testSetMessages($a, $b)
    {
        $messagesA = $a->getMessages();
        $messagesB = $b->getMessages();
        $this->object->addValidators(func_get_args());
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