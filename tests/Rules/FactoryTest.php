<?php

namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\Factory
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $prefixes;

    protected function setUp()
    {
        $this->prefixes = Factory::$prefixes;
    }

    protected function tearDown()
    {
        Factory::$prefixes = $this->prefixes;
    }

    public function testShouldBeAbleToAppendANewPrefix()
    {
        Factory::appendPrefix('My\\Validation\\Rules\\');

        $this->assertEquals(array('Respect\\Validation\\Rules\\', 'My\\Validation\\Rules\\'), Factory::$prefixes);
    }

    public function testShouldBeAbleToPrependANewPrefix()
    {
        Factory::prependPrefix('My\\Validation\\Rules\\');

        $this->assertEquals(array('My\\Validation\\Rules\\', 'Respect\\Validation\\Rules\\'), Factory::$prefixes);
    }

    public function testShouldCreateARuleByName()
    {
        $rule = new Factory('Uppercase');

        $this->assertInstanceOf('Respect\\Validation\\Rules\\Uppercase', $rule->rule);
    }

    public function testShouldDefineConstructorArgumentsWhenCreatingARule()
    {
        $rule = new Factory('date', array('Y-m-d'));

        $this->assertEquals('Y-m-d', $rule->rule->format);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "uterere" is not a valid rule name
     */
    public function testShouldThrowsAnExceptionWhenFactoryIsNotValid()
    {
        new Factory('uterere');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "Respect\Validation\Rules\NonRule" is not a valid respect rule
     */
    public function testShouldThrowsAnExceptionWhenRuleIsNotInstanceOfRuleInterface()
    {
        new Factory('nonRule');
    }

    public function testShouldUseRuleToValidate()
    {
        $rule = new Factory('Int');

        $this->assertTrue($rule->validate(123));
    }
}

class NonRule
{
}
