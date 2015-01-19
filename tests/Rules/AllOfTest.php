<?php
namespace Respect\Validation\Rules;

class AllOfTest extends \PHPUnit_Framework_TestCase
{
    public function testRemoveRulesShouldRemoveAllRules()
    {
        $o = new AllOf(new Int, new Positive);
        $o->removeRules();
        $this->assertEquals(0, count($o->getRules()));
    }

    public function testAddRulesUsingArrayOfRules()
    {
        $o = new AllOf();
        $o->addRules(
            array(
                array($x = new Int, new Positive)
            )
        );
        $this->assertTrue($o->hasRule($x));
        $this->assertTrue($o->hasRule('Positive'));
    }

    public function testAddRulesUsingSpecificationArray()
    {
        $o = new AllOf();
        $o->addRules(array("Between" => array(1, 2)));
        $this->assertTrue($o->hasRule('Between'));
    }

    public function testValidationShouldWorkIfAllRulesReturnTrue()
    {
        $valid1 = new Callback(function() {
                    return true;
                });
        $valid2 = new Callback(function() {
                    return true;
                });
        $valid3 = new Callback(function() {
                    return true;
                });
        $o = new AllOf($valid1, $valid2, $valid3);
        $this->assertTrue($o->__invoke('any'));
        $this->assertTrue($o->check('any'));
        $this->assertTrue($o->assert('any'));
        $this->assertTrue($o->__invoke(''));
        $this->assertTrue($o->check(''));
        $this->assertTrue($o->assert(''));
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException Respect\Validation\Exceptions\AllOfException
     */
    public function testValidationAssertShouldFailIfAnyRuleFailsAndReturnAllExceptionsFailed($v1, $v2, $v3)
    {
        $o = new AllOf($v1, $v2, $v3);
        $this->assertFalse($o->__invoke('any'));
        $this->assertFalse($o->assert('any'));
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function testValidationCheckShouldFailIfAnyRuleFailsAndThrowTheFirstExceptionOnly($v1, $v2, $v3)
    {
        $o = new AllOf($v1, $v2, $v3);
        $this->assertFalse($o->__invoke('any'));
        $this->assertFalse($o->check('any'));
    }

    /**
     * @dataProvider providerStaticDummyRules
     */
    public function testValidationCheckShouldNotFailOnEmptyInput($v1, $v2, $v3)
    {
        $o = new AllOf($v1, $v2, $v3);
        $this->assertTrue($o->__invoke(''));
        $this->assertTrue($o->check(''));
        $this->assertTrue($o->assert(''));
    }

    /**
     * @dataProvider providerStaticDummyRules
     */
    public function testValidationShouldFailIfAnyRuleFails($v1, $v2, $v3)
    {
        $o = new AllOf($v1, $v2, $v3);
        $this->assertFalse($o->__invoke('any'));
    }

    public function providerStaticDummyRules()
    {
        $theInvalidOne = new Callback(function() {
                    return false;
                });
        $valid1 = new Callback(function() {
                    return true;
                });
        $valid2 = new Callback(function() {
                    return true;
                });

        return array(
            array($theInvalidOne, $valid1, $valid2),
            array($valid2, $valid1, $theInvalidOne),
            array($valid2, $theInvalidOne, $valid1),
            array($valid1, $valid2, $theInvalidOne),
            array($valid1, $theInvalidOne, $valid2)
        );
    }
}

