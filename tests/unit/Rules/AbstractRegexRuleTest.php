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

class AbstractRegexRuleTest extends TestCase
{
    /**
     * @test
     */
    public function validateCleanShouldReturnOneIfPatternIsFound(): void
    {
        $regexRuleMock = $this->getMockForAbstractClass(AbstractRegexRule::class);
        $regexRuleMock->expects(self::once())
            ->method('getPregFormat')
            ->will(self::returnValue('/^Respect$/'));

        self::assertEquals(1, $regexRuleMock->validateClean('Respect'));
    }

    /**
     * @test
     */
    public function validateCleanShouldReturnZeroIfPatternIsNotFound(): void
    {
        $regexRuleMock = $this->getMockForAbstractClass(AbstractRegexRule::class);
        $regexRuleMock->expects(self::once())
            ->method('getPregFormat')
            ->will(self::returnValue('/^Respect$/'));

        self::assertEquals(0, $regexRuleMock->validateClean('Validation'));
    }
}
