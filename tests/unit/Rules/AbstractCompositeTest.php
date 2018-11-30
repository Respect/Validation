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

class AbstractCompositeTest extends TestCase
{
    public function testShouldDefineNameForInternalWhenAppendRuleToCompositeRule()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue(null));
        $simpleRuleMock
            ->expects($this->once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->setName($ruleName);
        $compositeRuleMock->addRule($simpleRuleMock);
    }

    public function testShouldUpdateInternalRuleNameWhenNameIsUpdated()
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->at(0))
            ->method('getName')
            ->will($this->returnValue(null));
        $simpleRuleMock
            ->expects($this->at(2))
            ->method('getName')
            ->will($this->returnValue($ruleName1));
        $simpleRuleMock
            ->expects($this->at(1))
            ->method('setName')
            ->with($ruleName1);
        $simpleRuleMock
            ->expects($this->at(3))
            ->method('setName')
            ->with($ruleName2);

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->setName($ruleName1);
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName2);
    }

    public function testShouldNotUpdateInternalRuleAlreadyHasAName()
    {
        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('something'));
        $simpleRuleMock
            ->expects($this->never())
            ->method('setName');

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName('Whatever');
    }

    public function testShouldUpdateInternalRuleWhenItsNameIsNull()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(null));
        $simpleRuleMock
            ->expects($this->once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    public function testShouldDefineNameForInternalRulesWhenItHasNotAName()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(null));
        $simpleRuleMock
            ->expects($this->once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    public function testShouldNotDefineNameForInternalRulesWhenItHasAName()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($ruleName));
        $simpleRuleMock
            ->expects($this->never())
            ->method('setName');

        $compositeRuleMock = $this
            ->getMockBuilder('Respect\\Validation\\Rules\\AbstractComposite')
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    public function testRemoveRulesShouldRemoveAllTheAddedRules()
    {
        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->removeRules();

        $this->assertEmpty($compositeRuleMock->getRules());
    }

    public function testShouldReturnTheAmountOfAddedRules()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($this->createMock('Respect\\Validation\\Validatable'));
        $compositeRuleMock->addRule($this->createMock('Respect\\Validation\\Validatable'));
        $compositeRuleMock->addRule($this->createMock('Respect\\Validation\\Validatable'));

        $this->assertCount(3, $compositeRuleMock->getRules());
    }

    public function testHasRuleShouldReturnFalseWhenThereIsNoRuleAppended()
    {
        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');

        $this->assertFalse($compositeRuleMock->hasRule(''));
    }

    public function testHasRuleShouldReturnFalseWhenRuleIsNotFound()
    {
        $oneSimpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($oneSimpleRuleMock);

        $anotherSimpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $this->assertFalse($compositeRuleMock->hasRule($anotherSimpleRuleMock));
    }

    public function testHasRuleShouldReturnFalseWhenRulePassedAsStringIsNotFound()
    {
        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($simpleRuleMock);

        $this->assertFalse($compositeRuleMock->hasRule('SomeRule'));
    }

    public function testHasRuleShouldReturnTrueWhenRuleIsFound()
    {
        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($simpleRuleMock);

        $this->assertTrue($compositeRuleMock->hasRule($simpleRuleMock));
    }

    public function testShouldAddRulesByPassingThroughConstructor()
    {
        $simpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');
        $anotherSimpleRuleMock = $this->createMock('Respect\\Validation\\Validatable');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite', [
            $simpleRuleMock,
            $anotherSimpleRuleMock
        ]);

        $this->assertCount(2, $compositeRuleMock->getRules());
    }
}
