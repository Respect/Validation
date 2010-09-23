<?php

namespace Respect\Validation;

use Mockery;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {

        $this->object = new Validator;
    }

    protected function tearDown()
    {
        
    }

    protected function buildMockValidator($name, array $messages, $invalid=false)
    {
        $validator = Mockery::mock('Respect\Validation\Validatable');
        if ($invalid) {
            $validator->shouldReceive('validate')->andThrow(
                new InvalidException('Always invalid, man.')
            );
            $validator->shouldReceive('isValid')->andReturn(false);
        } else {
            $validator->shouldReceive('isValid')->andReturn(true);
            $validator->shouldReceive('validate')->andReturn(true);
        }
        $validator->shouldReceive('getMessages')->andReturn(
            $messages
        );
        $className = 'Respect\Validation\Foo\\' . $name;
        if (!class_exists($className, false)) {
            eval("
                namespace Respect\Validation\Foo; 
                class $name implements \Respect\Validation\Validatable {
                    public function validate(\$input) {}
                    public function isValid(\$input) {}
                    public function setMessages(array \$messages) {}
                    public function getMessages() {
                        return " . var_export($messages, true) . ";
                    }
                } 
                ");
        }

        return $validator;
    }

    public function providerForMockImpossibleValidators()
    {
        $firstValidator = $this->buildMockValidator(
                'Bar', array('sfga', 'dfgb'), true
        );
        $secondValidator = $this->buildMockValidator(
                'Baz', array('dgd', 'dfgE', 'dfgf'), true
        );
        $thirdValidator = $this->buildMockValidator(
                'Bat', array('a34t'), true
        );
        return array(
            array($firstValidator, $secondValidator, $thirdValidator),
            array($secondValidator, $firstValidator, $thirdValidator),
            array($thirdValidator, $secondValidator, $firstValidator)
        );
    }

    public function providerForMockValidators()
    {
        $firstValidator = $this->buildMockValidator(
                'Bar', array('a435', 'b345'), false
        );
        $secondValidator = $this->buildMockValidator(
                'Baz', array('345d', '435E', 'f345'), false
        );
        $thirdValidator = $this->buildMockValidator(
                'Bat', array('345324a'), false
        );
        return array(
            array($firstValidator, $secondValidator, $thirdValidator),
            array($secondValidator, $firstValidator, $thirdValidator),
            array($thirdValidator, $secondValidator, $firstValidator)
        );
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
        $this->object->addValidator($a);
        $this->object->addValidator($b);
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
        $this->assertTrue($this->object->hasValidator('Respect\Validation\Foo\Bar'));
        $this->assertTrue($this->object->hasValidator('Respect\Validation\Foo\Baz'));
        $this->assertTrue($this->object->hasValidator('Respect\Validation\Foo\Bat'));
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
        $this->object->addValidator($a);
        $this->object->addValidator($b);
        $this->object->addValidator($c);
        $this->assertTrue($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockValidators
     */
    public function testManyIsValid($a, $b, $c)
    {
        $this->object->addValidator($a);
        $this->object->addValidator($b);
        $this->object->addValidator($c);
        $this->assertTrue($this->object->isValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid($a, $b, $c)
    {
        $this->object->addValidator($a);
        $this->object->addValidator($b);
        $this->object->addValidator($c);
        $this->assertFalse($this->object->isValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid2($a, $b, $c)
    {
        $this->object->addValidator($a);
        $this->object->addValidator($b);
        $this->object->addValidator($c);
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
        $this->object->addValidator($a);
        $this->object->addValidator($b);
        $this->object->addValidator($c);
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
        $this->object->addValidator($invalidA);
        $this->object->addValidator($invalidB);
        $this->object->addValidator($invalidC);
        $this->object->addValidator($valid);
        $this->assertTrue($this->object->validateOne('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $this->object->addValidator($invalidA);
        $this->object->addValidator($invalidB);
        $this->object->addValidator($invalidC);
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
        $this->object->addValidator($invalidA);
        $this->object->addValidator($invalidB);
        $this->object->addValidator($invalidC);
        $this->object->addValidator($valid);
        $this->assertTrue($this->object->isOneValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $this->object->addValidator($invalidA);
        $this->object->addValidator($invalidB);
        $this->object->addValidator($invalidC);
        $this->assertFalse($this->object->isOneValid('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testSetMessages($a, $b)
    {
        $messagesA = $a->getMessages();
        $messagesB = $b->getMessages();
        $this->object->addValidator($a);
        $this->object->addValidator($b);
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
        $this->object->addValidator($invalidA);
        $this->object->addValidator($invalidB);
        $this->object->addValidator($invalidC);
        $messages = $this->object->getMessages();
        $messages = array_map('strrev', $messages);
        array_pop($messages);
        $this->object->setMessages($messages);
        $this->assertEquals($messages, $this->object->getMessages());
    }

}