<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;

class NoneTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new None;
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneValid($invalidA, $invalidB, $invalidC)
    {
        $this->object->addRules(func_get_args());
        $this->assertTrue($this->object->assert('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRule($valid);
        $this->object->addRules(func_get_args());
        try {
            $this->object->assert('any');
        } catch (InvalidException $e) {
            $this->assertEquals(3, count($e->getExceptions()));
        }
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneValid($invalidA, $invalidB, $invalidC)
    {
        $this->object->addRules(func_get_args());
        $this->assertTrue($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testIsValidOneAllRotten($invalidA, $invalidB, $invalidC)
    {
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRule($valid);
        $this->object->addRules(func_get_args());
        $this->assertFalse($this->object->validate('any'));
    }

}