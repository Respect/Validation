<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;

class MostTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Most;
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneValid($invalidA, $invalidB, $invalidC)
    {
        $this->object->addRules(func_get_args());
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart2', array('Dart2_1' => 'sfg44'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart3', array('Dart3_1' => 'sfg44'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart4', array('Dart4_1' => 'sfg44'));
        $this->object->addRule($valid);
        $this->assertTrue($this->object->assert('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneValid($invalidA, $invalidB, $invalidC)
    {
        $this->object->addRules(func_get_args());
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart2', array('Dart2_1' => 'sfg44'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart2', array('Dart3_1' => 'sfg44'));
        $this->object->addRule($valid);
        $valid = $this->buildMockValidator('Dart4', array('Dart4_1' => 'sfg44'));
        $this->object->addRule($valid);
        $this->assertTrue($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $this->object->addRules(func_get_args());
        $this->assertFalse($this->object->validate('any'));
    }

}