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

class AbstractCtypeRuleTest extends TestCase
{
    /**
     * @test
     */
    public function validateCleanShouldReturnTrueWhenCtypeFunctionReturnsTrue(): void
    {
        $ctypeRuleMock = $this->getMockForAbstractClass(AbstractCtypeRule::class);
        $ctypeRuleMock->expects(self::once())
            ->method('ctypeFunction')
            ->will(self::returnValue(true));

        self::assertTrue($ctypeRuleMock->validateClean('anything'));
    }

    /**
     * @test
     */
    public function validateCleanShouldReturnFalseWhenCtypeFunctionReturnsFalse(): void
    {
        $ctypeRuleMock = $this->getMockForAbstractClass(AbstractCtypeRule::class);
        $ctypeRuleMock->expects(self::once())
            ->method('ctypeFunction')
            ->will(self::returnValue(false));

        self::assertFalse($ctypeRuleMock->validateClean('anything'));
    }
}
