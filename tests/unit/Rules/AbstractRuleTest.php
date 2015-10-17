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

use ReflectionObject;

class AbstractRuleTest extends \PHPUnit_Framework_TestCase
{
    /** @var Respect\Validation\Rules\AbstractRule */
    protected $abstractRuleMock;

    public function setUp()
    {
        $this->abstractRuleMock = $this->getMockForAbstractClass(
            '\\Respect\\Validation\\Rules\\AbstractRule'
        );
    }

    public function providerForTrueAndFalse()
    {
        return array(
            array(true),
            array(false)
        );
    }

    /**
     * @dataProvider providerForTrueAndFalse
     * @covers       Respect\Validation\Rules\AbstractRule::__invoke
     */
    public function testMagicMethodInvokeCallsValidateWithInput($booleanResult)
    {
        $this->abstractRuleMock->expects($this->once())
                               ->method('validate')
                               ->with('something')
                               ->will($this->returnValue($booleanResult));

        // Getting a reference outside the property in order to invoke it
        $abstractRuleInstance = $this->abstractRuleMock;

        $this->assertEquals(
            $booleanResult,
            // Invoking it to trigger __invoke
            $abstractRuleInstance('something'),
            'When invoking an instance of AbstractRule, the method validate should be called with the same input and return the same result.'
        );
    }

    /**
     * @covers Respect\Validation\Rules\AbstractRule::assert
     */
    public function testAssertInvokesValidatorOnSuccess()
    {
        $this->abstractRuleMock->expects($this->any())
                               ->method('validate')
                               ->with('something')
                               ->will($this->returnValue(true));

        $this->assertTrue(
            $this->abstractRuleMock->assert('something')
        );
    }
}


