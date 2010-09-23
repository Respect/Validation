<?php

namespace Respect\Validation;

class ValidatorTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Validator;
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
     * @expectedException InvalidArgumentException
     */
    public function testAddNonValidator()
    {
        $this->object->addValidator(new \stdClass);
    }

    /**
     * @expectedException InvalidArgumentException
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
     * @expectedException LogicException
     */
    public function testBuildValidatorsInvalid()
    {
        $this->providerForMockImpossibleValidators();
        $this->object->addValidators(array(
            'Foo\Bar', 'Foo\Baz', 'Foo\Bat' => 'balkbal'
        ));
    }

    /**
     * @dataProvider providerForMockValidators
     */
    public function testValidateManyValid($a, $b, $c)
    {
        $this->object->addValidators(func_get_args());
        $this->assertTrue($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockValidators
     */
    public function testManyIsValid($a, $b, $c)
    {
        $this->object->addValidators(func_get_args());
        $this->assertTrue($this->object->isValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid($a, $b, $c)
    {
        $this->object->addValidators(func_get_args());
        $this->assertFalse($this->object->isValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid2($a, $b, $c)
    {
        $this->object->addValidators(func_get_args());
        $this->object->addValidator(
            $this->buildMockValidator('Aids', array('ergera'))
        );
        $this->assertFalse($this->object->isValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateAllInvalid($a, $b, $c)
    {
        $this->object->addValidators(func_get_args());
        try {
            $this->object->validate('any');
        } catch (InvalidException $e) {
            $this->assertEquals(3, count($e->getExceptions()));
        }
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneValid($invalidA, $invalidB, $invalidC)
    {
        $valid = $this->buildMockValidator('Darth', array('o54n'));
        $this->object->addValidators(func_get_args());
        $this->object->addValidator($valid);
        $this->assertTrue($this->object->validateOne('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $this->object->addValidators(func_get_args());
        try {
            $this->object->validateOne('any');
        } catch (InvalidException $e) {
            $this->assertEquals(3, count($e->getExceptions()));
        }
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneValid($invalidA, $invalidB, $invalidC)
    {
        $valid = $this->buildMockValidator('Darth', array('o54n'));
        $this->object->addValidators(func_get_args());
        $this->object->addValidator($valid);
        $this->assertTrue($this->object->isOneValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $this->object->addValidators(func_get_args());
        $this->assertFalse($this->object->isOneValid('any'));
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

    /**
     * @dataProvider providerForMockImpossibleValidators
     * @expectedException OutOfRangeException
     */
    public function testSetInvalidMessages($invalidA, $invalidB, $invalidC)
    {
        $this->object->addValidators(func_get_args());
        $messages = $this->object->getMessages();
        $messages = array_map('strrev', $messages);
        array_pop($messages);
        $this->object->setMessages($messages);
        $this->assertEquals($messages, $this->object->getMessages());
    }

}