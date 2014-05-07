<?php

namespace Respect\Validation;

/**
 * @covers Respect\Validation\Factory
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldHaveRulePrefixesByDefault()
    {
        $factory = new Factory();

        $this->assertEquals(array('Respect\\Validation\\Rules\\'), $factory->getRulePrefixes());
    }

    public function testShouldBeAbleToAppendANewPrefix()
    {
        $factory = new Factory();
        $factory->appendRulePrefix('My\\Validation\\Rules\\');

        $this->assertEquals(array('Respect\\Validation\\Rules\\', 'My\\Validation\\Rules\\'), $factory->getRulePrefixes());
    }

    public function testShouldBeAbleToPrependANewRulePrefix()
    {
        $factory = new Factory();
        $factory->prependRulePrefix('My\\Validation\\Rules\\');

        $this->assertEquals(array('My\\Validation\\Rules\\', 'Respect\\Validation\\Rules\\'), $factory->getRulePrefixes());
    }

    public function testShouldCreateARuleByName()
    {
        $factory = new Factory();

        $this->assertInstanceOf('Respect\\Validation\\Rules\\Uppercase', $factory->rule('uppercase'));
    }

    public function testShouldDefineConstructorArgumentsWhenCreatingARule()
    {
        $factory = new Factory();
        $rule = $factory->rule('date', array('Y-m-d'));

        $this->assertEquals('Y-m-d', $rule->format);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "uterere" is not a valid rule name
     */
    public function testShouldThrowsAnExceptionWhenRuleNameIsNotValid()
    {
        $factory = new Factory();
        $factory->rule('uterere');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "Respect\Validation\TestNonRule" is not a valid respect rule
     */
    public function testShouldThrowsAnExceptionWhenRuleIsNotInstanceOfRuleInterface()
    {
        $factory = new Factory();
        $factory->appendRulePrefix('Respect\\Validation\\Test');
        $factory->rule('nonRule');
    }
}

class TestNonRule
{
}
