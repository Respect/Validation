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

    private $testValidateTrue = true;
    private $testValidateFalse = false;    
    private $testValidateNull = null;
    private $testValidateEmptyWithDoubleQuotes = "";
    private $testValidateEmptyWithSingleQuotes = '';
    private $testValidateArrayLangs = array("goLang", "java", "python", "cLang", "F#");
    private $testValidateNotInArrayLangs = "js";
    private $testValidateMockPath = "Respect\\Validation\\Rules\\AbstractSearcher";
    
    public function testValidateMethodWhenArgsIsNullCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateFalse;
        $this->assertTrue($compositeRuleMock->validate($this->testValidateNull));
    }

    public function testValidateMethodWhenArgsIsNullCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateTrue;
        $this->assertTrue($compositeRuleMock->validate($this->testValidateNull));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithDoubleQuotesCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateFalse;
        $this->assertTrue($compositeRuleMock->validate($this->testValidateEmptyWithDoubleQuotes));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithDoubleQuotesCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateTrue;
        $this->assertFalse($compositeRuleMock->validate($this->testValidateEmptyWithDoubleQuotes));
    }    
    
    public function testValidateMethodWhenArgsIsEmptyWithSingleQuotesCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateFalse;     
        $this->assertTrue($compositeRuleMock->validate($this->testValidateEmptyWithSingleQuotes));
    }
    
    public function testValidateMethodWhenArgsIsEmptyWithSingleQuotesCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->compareIdentical = $this->testValidateTrue;
        $this->assertFalse($compositeRuleMock->validate($this->testValidateEmptyWithSingleQuotes));
    }    
    
    public function testValidateMethodWhenArgsNotIsInArrayHaystackCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->haystack = $this->testValidateArrayLangs;
        $compositeRuleMock->compareIdentical = $this->testValidateFalse;
        $this->assertFalse($compositeRuleMock->validate($this->testValidateNotInArrayLangs));
    }
    
    public function testValidateMethodWhenArgsNotIsInArrayHaystackCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->haystack = $this->testValidateArrayLangs;
        $compositeRuleMock->compareIdentical = $this->testValidateTrue;
        $this->assertFalse($compositeRuleMock->validate($this->testValidateNotInArrayLangs));
    }    
    
    public function testValidateMethodWhenArgsIsInArrayHaystackCompareIdenticalFalse()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->haystack = $this->testValidateArrayLangs;
        $compositeRuleMock->compareIdentical = $this->testValidateFalse;
        $this->assertTrue($compositeRuleMock->validate($this->testValidateArrayLangs[1]));
    }
    
    public function testValidateMethodWhenArgsIsInArrayHaystackCompareIdenticalTrue()
    {
        $compositeRuleMock = $this->getMockForAbstractClass($this->testValidateMockPath);
        $compositeRuleMock->haystack = $this->testValidateArrayLangs;
        $compositeRuleMock->compareIdentical = $this->testValidateTrue;
        $this->assertTrue($compositeRuleMock->validate($this->testValidateArrayLangs[1]));
    }        
}
