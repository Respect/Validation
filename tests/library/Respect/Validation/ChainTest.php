<?php

namespace Respect\Validation;

class ChainTest extends ValidatorTestCase
{

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testSimpleChainValidators()
    {
        $validator = Chain::validFoo('Bar', 'Baz', 'Bat');
        $this->assertValidatorPresence($validator, 'Bar', 'Baz', 'Bat');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testNotSoSimpleChainValidators()
    {
        $validator = Chain::validFoo('Bar', 'Baz')->validFoo('Bat');
        $this->assertValidatorPresence($validator, 'Bar', 'Baz', 'Bat');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testComplexChainValidators()
    {
        $validator = Chain::validFoo(array(
                'Bar',
                'Baz' => array(234, 2342)
            ))->validFoo('Bat');
        $this->assertValidatorPresence($validator, 'Bar', 'Baz', 'Bat');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testAll()
    {
        $validator = Chain::all(
                'Foo\Bar', 'Foo\Baz', 'Foo\Bat'
        );
        $this->assertValidatorPresence($validator, 'Bar', 'Baz', 'Bat');
    }

    /**
     * @dataProvider providerForMockImpossibleValidators
     */
    public function testAllArray()
    {
        $validator = Chain::all(
                array('Foo\Bar', 'Foo\Baz', 'Foo\Bat')
        );
        $this->assertValidatorPresence($validator, 'Bar', 'Baz', 'Bat');
    }


}