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
 * @covers Respect\Validation\Rules\AbstractSearcher
 */ 

class AbstractSearcherTest extends \PHPUnit_Framework_TestCase
{

    public function testValidateMethodWhenArgsIsNull()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->expects($this->any())
             ->method('validate')
             ->will($this->returnValue(true));
        $this->assertTrue($compositeRuleMock->validate(null));
    }

    public function testValidateMethodWhenArgsIsEmptyWithDoubleQuotes()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->expects($this->any())
             ->method('validate')
             ->will($this->returnValue(true));
        $this->assertTrue($compositeRuleMock->validate(""));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithSingleQuotes()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->expects($this->any())
             ->method('validate')
             ->will($this->returnValue(true));
        $this->assertTrue($compositeRuleMock->validate(''));
    }
    
}
