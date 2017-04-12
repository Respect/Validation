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
 * @covers \Respect\Validation\Rules\When
 */
class WhenTest extends RuleTestCase
{
    public function testShouldConstructAnObjectWithoutElseRule()
    {
        $rule = new When($this->getRuleMock(true), $this->getRuleMock(true));

        $this->assertInstanceOf(AlwaysInvalid::class, $rule->else);
    }

    public function testShouldConstructAnObjectWithElseRule()
    {
        $rule = new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true));

        $this->assertNotNull($rule->else);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ThenNotValid:assert() method
     */
    public function testShouldThrowExceptionForTheThenRuleWhenTheIfRuleIsValidAndTheThenRuleIsNotOnAssertMethod()
    {
        $if = $this->getRuleMock(true);
        $then = $this->getRuleMock(false, 'ThenNotValid');
        $else = $this->getRuleMock(true);

        $rule = new When($if, $then, $else);
        $rule->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ThenNotValid:check() method
     */
    public function testShouldThrowExceptionForTheThenRuleWhenTheIfRuleIsValidAndTheThenRuleIsNotOnCheckMethod()
    {
        $if = $this->getRuleMock(true);
        $then = $this->getRuleMock(false, 'ThenNotValid');
        $else = $this->getRuleMock(true);

        $rule = new When($if, $then, $else);
        $rule->check('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ElseNotValid:assert() method
     */
    public function testShouldThrowExceptionForTheElseRuleWhenTheIfRuleIsNotValidAndTheElseRuleIsNotOnAssertMethod()
    {
        $if = $this->getRuleMock(false);
        $then = $this->getRuleMock(false);
        $else = $this->getRuleMock(false, 'ElseNotValid');

        $rule = new When($if, $then, $else);
        $rule->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ElseNotValid:check() method
     */
    public function testShouldThrowExceptionForTheElseRuleWhenTheIfRuleIsNotValidAndTheElseRuleIsNotOnCheckMethod()
    {
        $if = $this->getRuleMock(false);
        $then = $this->getRuleMock(false);
        $else = $this->getRuleMock(false, 'ElseNotValid');

        $rule = new When($if, $then, $else);
        $rule->check('');
    }

    /**
     * It is to provide constructor arguments and.
     *
     * @return array
     */
    public function providerForValidInput()
    {
        return [
            'int (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                42,
            ],
            'bool (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                true,
            ],
            'empty (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                '',
            ],
            'object (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                new \stdClass(),
            ],
            'empty array (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                [],
            ],
            'not empty array (all true)' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(true)),
                ['test'],
            ],
            'when = true, then = false, else = true' => [
                new When($this->getRuleMock(true), $this->getRuleMock(true), $this->getRuleMock(false)),
                false,
            ],

        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidInput()
    {
        return [
            'when = true, then = false, else = false' => [
                new When($this->getRuleMock(true), $this->getRuleMock(false), $this->getRuleMock(false)),
                false,
            ],
            'when = true, then = false, else = true' => [
                new When($this->getRuleMock(true), $this->getRuleMock(false), $this->getRuleMock(true)),
                false,
            ],
            'when = false, then = false, else = false' => [
                new When($this->getRuleMock(false), $this->getRuleMock(false), $this->getRuleMock(false)),
                false,
            ],
        ];
    }
}
