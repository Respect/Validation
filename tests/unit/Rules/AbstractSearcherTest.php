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

    public function testValidateMethodWhenArgsIsNullCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = false;
        $this->assertTrue($compositeRuleMock->validate(null));
    }

    public function testValidateMethodWhenArgsIsNullCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = true;
        $this->assertTrue($compositeRuleMock->validate(null));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithDoubleQuotesCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = false;
        $this->assertTrue($compositeRuleMock->validate(""));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithDoubleQuotesCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = true;
        $this->assertFalse($compositeRuleMock->validate(""));
    }    
    
    public function testValidateMethodWhenArgsIsEmptyWithSingleQuotesCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = false;     
        $this->assertTrue($compositeRuleMock->validate(''));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithSingleQuotesCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->compareIdentical = true;
        $this->assertFalse($compositeRuleMock->validate(''));
    }    
    
    public function testValidateMethodWhenArgsNotIsInArrayHaystackCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->haystack = array("goLang","java","python");
        $compositeRuleMock->compareIdentical = false;
        $this->assertFalse($compositeRuleMock->validate("js"));
    }
    
    public function testValidateMethodWhenArgsNotIsInArrayHaystackCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->haystack = array("goLang","java","python");
        $compositeRuleMock->compareIdentical = true;
        $this->assertFalse($compositeRuleMock->validate("js"));
    }    
    
    public function testValidateMethodWhenArgsIsInArrayHaystackCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->haystack = array("goLang","java","python");
        $compositeRuleMock->compareIdentical = false;
        $this->assertTrue($compositeRuleMock->validate("java"));
    }
    
    public function testValidateMethodWhenArgsIsInArrayHaystackCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
        $compositeRuleMock->haystack = array("goLang","java","python");
        $compositeRuleMock->compareIdentical = true;
        $this->assertTrue($compositeRuleMock->validate("java"));
    }        
}
