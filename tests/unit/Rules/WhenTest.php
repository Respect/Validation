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
 * @covers \Respect\Validation\Rules\When
 */
class WhenTest extends RuleTestCase
{
    public function testShouldConstructAnObjectWithoutElseRule(): void
    {
        $rule = new When($this->createValidatableMock(true), $this->createValidatableMock(true));

        self::assertInstanceOf(AlwaysInvalid::class, $rule->else);
    }

    public function testShouldConstructAnObjectWithElseRule(): void
    {
        $rule = new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true));

        self::assertNotNull($rule->else);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ThenNotValid:assert() method
     */
    public function testShouldThrowExceptionForTheThenRuleWhenTheIfRuleIsValidAndTheThenRuleIsNotOnAssertMethod(): void
    {
        $if = $this->createValidatableMock(true);
        $then = $this->createValidatableMock(false, 'ThenNotValid');
        $else = $this->createValidatableMock(true);

        $rule = new When($if, $then, $else);
        $rule->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ThenNotValid:check() method
     */
    public function testShouldThrowExceptionForTheThenRuleWhenTheIfRuleIsValidAndTheThenRuleIsNotOnCheckMethod(): void
    {
        $if = $this->createValidatableMock(true);
        $then = $this->createValidatableMock(false, 'ThenNotValid');
        $else = $this->createValidatableMock(true);

        $rule = new When($if, $then, $else);
        $rule->check('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ElseNotValid:assert() method
     */
    public function testShouldThrowExceptionForTheElseRuleWhenTheIfRuleIsNotValidAndTheElseRuleIsNotOnAssertMethod(): void
    {
        $if = $this->createValidatableMock(false);
        $then = $this->createValidatableMock(false);
        $else = $this->createValidatableMock(false, 'ElseNotValid');

        $rule = new When($if, $then, $else);
        $rule->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     * @expectedExceptionMessage Exception for ElseNotValid:check() method
     */
    public function testShouldThrowExceptionForTheElseRuleWhenTheIfRuleIsNotValidAndTheElseRuleIsNotOnCheckMethod(): void
    {
        $if = $this->createValidatableMock(false);
        $then = $this->createValidatableMock(false);
        $else = $this->createValidatableMock(false, 'ElseNotValid');

        $rule = new When($if, $then, $else);
        $rule->check('');
    }

    /**
     * It is to provide constructor arguments and.
     *
     * @return array
     */
    public function providerForValidInput(): array
    {
        return [
            'int (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                42,
            ],
            'bool (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                true,
            ],
            'empty (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                '',
            ],
            'object (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                new \stdClass(),
            ],
            'empty array (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                [],
            ],
            'not empty array (all true)' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(true)),
                ['test'],
            ],
            'when = true, then = false, else = true' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(true), $this->createValidatableMock(false)),
                false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidInput(): array
    {
        return [
            'when = true, then = false, else = false' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(false), $this->createValidatableMock(false)),
                false,
            ],
            'when = true, then = false, else = true' => [
                new When($this->createValidatableMock(true), $this->createValidatableMock(false), $this->createValidatableMock(true)),
                false,
            ],
            'when = false, then = false, else = false' => [
                new When($this->createValidatableMock(false), $this->createValidatableMock(false), $this->createValidatableMock(false)),
                false,
            ],
        ];
    }
}
