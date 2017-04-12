<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Each
 * @covers \Respect\Validation\Exceptions\EachException
 */
class EachTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $ruleNotEmpty = new Each($this->getRuleMock(true));
        $ruleAlphaItemIntKey = new Each($this->getRuleMock(true), $this->getRuleMock(true));
        $ruleOnlyKeyValidation = new Each(null, $this->getRuleMock(true));

        $intStack = new \SplStack();
        $intStack->push(1);
        $intStack->push(2);
        $intStack->push(3);
        $intStack->push(4);
        $intStack->push(5);

        $stdClass = new \stdClass();
        $stdClass->name = 'Emmerson';
        $stdClass->age = 22;

        return [
            [$ruleNotEmpty, [1, 2, 3, 4, 5]],
            [$ruleNotEmpty, $intStack],
            [$ruleNotEmpty, $stdClass],
            [$ruleAlphaItemIntKey, ['a', 'b', 'c', 'd', 'e']],
            [$ruleOnlyKeyValidation, ['a', 'b', 'c', 'd', 'e']],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new Each($this->getRuleMock(false));
        $ruleOnlyKeyValidation = new Each(null, $this->getRuleMock(false));

        return [
            [$rule, 123],
            [$rule, ''],
            [$rule, null],
            [$rule, false],
            [$rule, ['', 2, 3, 4, 5]],
            [$ruleOnlyKeyValidation, ['age' => 22]],
        ];
    }

    public function testValidatorShouldPassIfEveryArrayItemPass()
    {
        $v = new Each($this->getRuleMock(true));
        $result = $v->check([1, 2, 3, 4, 5]);
        $this->assertTrue($result);
        $result = $v->assert([1, 2, 3, 4, 5]);
        $this->assertTrue($result);
    }

    public function testValidatorShouldPassIfEveryArrayItemAndKeyPass()
    {
        $v = new Each($this->getRuleMock(true), $this->getRuleMock(true));
        $result = $v->check(['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($result);
        $result = $v->assert(['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($result);
    }

    public function testValidatorShouldPassWithOnlyKeyValidation()
    {
        $v = new Each(null, $this->getRuleMock(true));
        $result = $v->check(['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($result);
        $result = $v->assert(['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($result);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testValidatorShouldNotPassWithOnlyKeyValidation()
    {
        $v = new Each(null, $this->getRuleMock(false));
        $v->assert(['a', 'b', 'c', 'd', 'e']);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testAssertShouldFailOnInvalidItem()
    {
        $v = new Each($this->getRuleMock(false));
        $v->assert(['a', 2, 3, 4, 5]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testAssertShouldFailWithNonIterableInput()
    {
        $v = new Each($this->getRuleMock(false));
        $v->assert('a');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testCheckShouldFailWithNonIterableInput()
    {
        $v = new Each($this->getRuleMock(false));
        $v->check(null);
    }
}
