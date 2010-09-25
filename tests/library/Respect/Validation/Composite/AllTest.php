<?php

namespace Respect\Validation\Composite;

use Respect\Validation\ValidatorTestCase;
use Respect\Validation\InvalidException;

class AllTest extends ValidatorTestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new All;
    }

    /**
     * @dataProvider providerForMockValidators
     */
    public function testValidateManyValid($a, $b, $c)
    {
        $this->object->addRules(func_get_args());
        $this->assertTrue($this->object->assert('any'));
    }

    /**
     * @dataProvider providerForMockValidators
     */
    public function testManyIsValid($a, $b, $c)
    {
        $this->object->addRules(func_get_args());
        $this->assertTrue($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid($a, $b, $c)
    {
        $this->object->addRules(func_get_args());
        $this->assertFalse($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testManyIsInvalid2($a, $b, $c)
    {
        $this->object->addRules(func_get_args());
        $this->object->addRule(
            $this->buildMockValidator('Aids', array('Aids_1' => 'aesfg'))
        );
        $this->assertFalse($this->object->validate('any'));
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testValidateAllInvalid($a, $b, $c)
    {
        $this->object->addRules(func_get_args());
        try {
            $this->object->assert('any');
        } catch (InvalidException $e) {
            $this->assertEquals(3, count($e->getExceptions()));
        }
    }

}