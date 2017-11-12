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

use PHPUnit\Framework\TestCase;

class AbstractRegexRuleTest extends TestCase
{
    public function testValidateCleanShouldReturnOneIfPatternIsFound()
    {
        $regexRuleMock = $this->getMockForAbstractClass(AbstractRegexRule::class);
        $regexRuleMock->expects($this->once())
            ->method('getPregFormat')
            ->will($this->returnValue('/^Respect$/'));

        self::assertEquals(1, $regexRuleMock->validateClean('Respect'));
    }

    public function testValidateCleanShouldReturnZeroIfPatternIsNotFound()
    {
        $regexRuleMock = $this->getMockForAbstractClass(AbstractRegexRule::class);
        $regexRuleMock->expects($this->once())
            ->method('getPregFormat')
            ->will($this->returnValue('/^Respect$/'));

        self::assertEquals(0, $regexRuleMock->validateClean('Validation'));
    }
}
