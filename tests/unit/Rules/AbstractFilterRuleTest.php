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

use PHPUnit\Framework\TestCase;

/**
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 */
class AbstractFilterRuleTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Invalid list of additional characters to be loaded
     *
     * @test
     */
    public function constructorShouldThrowExceptionIfParamIsNotString(): void
    {
        $this->getMockForAbstractClass(AbstractFilterRule::class, [1]);
    }

    /**
     * @test
     */
    public function validateShouldReturnTrueForValidArguments(): void
    {
        $filterRuleMock = $this->getMockForAbstractClass(AbstractFilterRule::class);
        $filterRuleMock->expects(self::any())
            ->method('validateClean')
            ->will(self::returnValue(true));

        self::assertTrue($filterRuleMock->validate('hey'));
    }

    /**
     * @test
     */
    public function validateShouldReturnFalseForInvalidArguments(): void
    {
        $filterRuleMock = $this->getMockForAbstractClass(AbstractFilterRule::class);
        $filterRuleMock->expects(self::any())
            ->method('validateClean')
            ->will(self::returnValue(true));

        self::assertFalse($filterRuleMock->validate(''));
        self::assertFalse($filterRuleMock->validate([]));
    }
}
