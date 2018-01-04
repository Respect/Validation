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

class AbstractFilterRuleTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Invalid list of additional characters to be loaded
     */
    public function testConstructorShouldThrowExceptionIfParamIsNotString(): void
    {
        $this->getMockForAbstractClass(AbstractFilterRule::class, [1]);
    }

    public function testValidateShouldReturnTrueForValidArguments(): void
    {
        $filterRuleMock = $this->getMockForAbstractClass(AbstractFilterRule::class);
        $filterRuleMock->expects($this->any())
            ->method('validateClean')
            ->will($this->returnValue(true));

        self::assertTrue($filterRuleMock->validate('hey'));
    }

    public function testValidateShouldReturnFalseForInvalidArguments(): void
    {
        $filterRuleMock = $this->getMockForAbstractClass(AbstractFilterRule::class);
        $filterRuleMock->expects($this->any())
            ->method('validateClean')
            ->will($this->returnValue(true));

        self::assertFalse($filterRuleMock->validate(''));
        self::assertFalse($filterRuleMock->validate([]));
    }
}
