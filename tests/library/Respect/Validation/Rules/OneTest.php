<?php

namespace Respect\Validation\Rules;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\Exceptions\InvalidException;

class OneTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new One;
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneValid($invalidA, $invalidB, $invalidC)
    {
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRules(func_get_args());
        $this->object->addRule($valid);
        $this->assertTrue($this->object->assert('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateOneAllRotten($invalidA, $invalidB, $invalidC)
    {
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
        $valid = $this->buildMockValidator('Darth', array('Darth_1' => 'o54n'));
        $this->object->addRules(func_get_args());
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