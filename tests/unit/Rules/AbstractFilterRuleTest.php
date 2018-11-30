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

use Respect\Validation\TestCase;

class AbstractFilterRuleTest extends TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Invalid list of additional characters to be loaded
     */
    public function testConstructorShouldThrowExceptionIfParamIsNotString()
    {
        $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractFilterRule', [1]);
    }

    public function testValidateShouldReturnTrueForValidArguments()
    {
        $filterRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractFilterRule');
        $filterRuleMock->expects($this->any())
            ->method('validateClean')
            ->will($this->returnValue(true));

        $this->assertTrue($filterRuleMock->validate('hey'));
    }

    public function testValidateShouldReturnFalseForInvalidArguments()
    {
        $filterRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractFilterRule');
        $filterRuleMock->expects($this->any())
            ->method('validateClean')
            ->will($this->returnValue(true));

        $this->assertFalse($filterRuleMock->validate(''));
        $this->assertFalse($filterRuleMock->validate([]));
    }
}
