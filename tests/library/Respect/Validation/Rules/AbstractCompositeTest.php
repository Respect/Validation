<?php
namespace Respect\Validation\Rules;

class AbstractCompositeTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldDefineNameForInternalRulesWhenItHasNotAName()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->getMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue(null));
        $simpleRuleMock
            ->expects($this->once())
            ->method('setName')
            ->with($ruleName)
            ->will($this->returnValue($ruleName));

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    public function testShouldNotDefineNameForInternalRulesWhenItHasAName()
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->getMock('Respect\\Validation\\Validatable');
        $simpleRuleMock
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue($ruleName));
        $simpleRuleMock
            ->expects($this->never())
            ->method('setName');

        $compositeRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractComposite');
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }
}
