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

class AbstractRegexRuleTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateCleanShouldReturnOneIfPatternIsFound()
    {
        $regexRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractRegexRule');
        $regexRuleMock->expects($this->any())
            ->method('getPregFormat')
            ->will($this->returnValue('/^Respect$/'));

        $this->assertEquals(1, $regexRuleMock->validateClean('Respect'));

    }

    public function testValidateCleanShouldReturnZeroIfPatternIsNotFound()
    {
        $regexRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractRegexRule');
        $regexRuleMock->expects($this->any())
            ->method('getPregFormat')
            ->will($this->returnValue('/^Respect$/'));

        $this->assertEquals(0, $regexRuleMock->validateClean('Validation'));
    }
}
