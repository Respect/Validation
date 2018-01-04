<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Each
 * @covers \Respect\Validation\Exceptions\EachException
 */
class EachTest extends RuleTestCase
{
    protected function setUp(): void
    {
        $this->markTestIncomplete(self::class.' needs to be refactored');
    }

    public function providerForValidInput(): array
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

    public function providerForInvalidInput(): array
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

    public function testValidatorShouldPassIfEveryArrayItemPass(): void
    {
        $v = new Each($this->getRuleMock(true));
        $result = $v->check([1, 2, 3, 4, 5]);
        self::assertTrue($result);
        $result = $v->assert([1, 2, 3, 4, 5]);
        self::assertTrue($result);
    }

    public function testValidatorShouldPassIfEveryArrayItemAndKeyPass(): void
    {
        $v = new Each($this->getRuleMock(true), $this->getRuleMock(true));
        $result = $v->check(['a', 'b', 'c', 'd', 'e']);
        self::assertTrue($result);
        $result = $v->assert(['a', 'b', 'c', 'd', 'e']);
        self::assertTrue($result);
    }

    public function testValidatorShouldPassWithOnlyKeyValidation(): void
    {
        $v = new Each(null, $this->getRuleMock(true));
        $result = $v->check(['a', 'b', 'c', 'd', 'e']);
        self::assertTrue($result);
        $result = $v->assert(['a', 'b', 'c', 'd', 'e']);
        self::assertTrue($result);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testValidatorShouldNotPassWithOnlyKeyValidation(): void
    {
        $v = new Each(null, $this->getRuleMock(false));
        $v->assert(['a', 'b', 'c', 'd', 'e']);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testAssertShouldFailOnInvalidItem(): void
    {
        $v = new Each($this->getRuleMock(false));
        $v->assert(['a', 2, 3, 4, 5]);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testAssertShouldFailWithNonIterableInput(): void
    {
        $v = new Each($this->getRuleMock(false));
        $v->assert('a');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\EachException
     */
    public function testCheckShouldFailWithNonIterableInput(): void
    {
        $v = new Each($this->getRuleMock(false));
        $v->check(null);
    }
}
