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

use Respect\Validation\Validator;
use Respect\Validation\Exceptions;

/**
 * @group rule
 * @group integration
 * @covers Respect\Validation\Rules\Not
 * @covers Respect\Validation\Validator
 */
class NotTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideRulesWithInvalidValuesWhichWouldBeValidWhenNegated
     */
    public function testNotRuleWithValidValuesPassedAsConstructorArgumentsToTheRule($ruleToNegate, $validInputForNegativeRule)
    {
        $not = new Not($ruleToNegate);

        $this->assertTrue(
            $not->assert($validInputForNegativeRule),
            'An input given to Not rule should make previously invalid values, valid. Using `assert` method.'
        );
        $this->assertTrue(
            $not->validate($validInputForNegativeRule),
            'An input given to Not rule should make previously invalid values, valid. Using `validate` method.'
        );
        $this->assertTrue(
            $not->check($validInputForNegativeRule),
            'An input given to Not rule should make previously invalid values, valid. Using `check` method.'
        );
    }

    public function provideRulesWithInvalidValuesWhichWouldBeValidWhenNegated()
    {
        return array(
            'Single rule (Int)' => array(
                'Must be an integer' => new Int(),
                'invalidValueForRuleAbove' => 'aaa'
            ),
            'Composite rule (AllOf) with two rules, failing just for all rules' => array(
                'Must be digits without withespaces' => new AllOf(new NoWhitespace(), new Digit()),
                'invalidValueForRuleAbove' => 'To infinity and beyond!'
            ),
            'Composite rule (AllOf) with two rules, failing just for one rule' => array(
                'Must be an alpha-numeric string without whitespaces' => new AllOf(new NoWhitespace(), new Alnum()),
                'invalidValueForRuleAbove' => 'To infinity and beyond'
            ),
            'Composite of nested rules (AllOf > AllOf), failing for nested rule' => array(
                'Must be an alpha-numeric string without whitespaces' => new AllOf(new AllOf(new NoWhitespace(), new Alnum())),
                'invalidValueForRuleAbove' => 'I have whitespaces'
            ),
            'Composite with nested rules (AllOf > NoneOf), failing for nested rule' => array(
                'Not a number neither boolean' => new AllOf(new NoneOf(new Numeric(), new Bool()), new NoWhitespace()),
                'invalidValueForRuleAbove' => 13.37
            ),
            'Composite (NoneOf), failing for one rule' => array(
                'Not a number neither a boolean' => new NoneOf(new Numeric(), new Bool()),
                'invalidValueForRuleAbove' => 13.37
            ),
            'Composite (NoneOf), failing for one rule, created with static API' => array(
                'Not a number neither a boolean' => Validator::noneOf(Validator::numeric(), Validator::bool()),
                'invalidValueForRuleAbove' => 13.37
            ),
        );
    }

    /**
     * @dataProvider provideRuleAndValidValueForRule
     */
    public function testNotRuleWithValidValueForNegatedRuleShouldFail($ruleToNegate, $validInputPreviousToNegation)
    {
        $not = new Not($ruleToNegate);

        $assertionExplanation = 'A previously valid value for rule, when negated should become invalid. Using `%s` method.';
        $this->assertFalse(
            $not->validate($validInputPreviousToNegation),
            sprintf($assertionExplanation, 'validate')
        );

        try {
            $this->assertFalse(
                $not->check($validInputPreviousToNegation),
                sprintf($assertionExplanation, 'check')
            );
        } catch (Exceptions\ValidationException $e) {
            // Test should proceed to `assert` method usage.
        }

        try {
            $this->assertFalse(
                $not->assert($validInputPreviousToNegation),
                sprintf($assertionExplanation, 'assert')
            );
        } catch (Exceptions\ValidationException $e) {
            return 'An exception should be thrown and test should be ended here.';
        }

        $this->fail('An exception should have been thrown and catch afetr test with `assert` method.');
    }


    public function provideRuleAndValidValueForRule()
    {
        return array(
            'Empty (optional) values should always be valid' => array(
                'Must be integer' => new Int(),
                'Empty values are treated as optional' => ''
            ),
            'Single rule (Int)' => array(
                'Must be integer' => new Int(),
                'Valid integer' => 123
            ),
            'Composite of nested rules (AllOf > OneOf)' => array(
                'Must be a number or a bollean, greater than 1' => new AllOf(new OneOf(new Numeric(), new Bool()), new Min(1)),
                'Valid value for rule above' => 13.37
            ),
            'Composite rule (OneOf)' => array(
                'Must be a number or a boolean' => new OneOf(new Numeric(), new Bool()),
                'Valid value for rule above' => true
            ),
            'Composite rule created with static API' => array(
                'Must be a number or a boolean' => Validator::oneOf(Validator::numeric(), Validator::bool()),
                'Valid value for rule above' => 13.37
            ),
        );
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testShortcutApiWithInvalidValueShouldFail()
    {
        $notAnIntegerRule = Validator::int()->not();
        $invalidValue = 10;

        $this->assertFalse(
            $notAnIntegerRule->validate($invalidValue),
            'The shortcut should invert all previous rules, making a previously invalid rule ' .
            'a valid one. Passing a valid value for previous rule after negating it should cause ' .
            'the validation to fail.'
        );

        $notAnIntegerRule->assert($invalidValue);
    }

    public function testExceptionMessageForASingleRule()
    {
        $notAnIntegerRule = new Not(new Int());
        $validInteger = 10;
        $expectedMessage = '"10" must not be an integer number';

        try {
            $notAnIntegerRule->assert($validInteger);
        } catch (Exceptions\IntException $e) {
            $this->assertEquals(
                $expectedMessage,
                $e->getMainMessage(),
                'Main exception message should use the NEGATIVE template of the rule\'s exception class.'
           );
            $this->assertEquals(
                $expectedMessage,
                $e->getMessage(),
                'Exception message property should have the same value of the main exception message API.'
            );

            return 'This test must end here.';
        }

        $this->fail('An exception should be provoked and its message should have been checked.');
    }

    public function testExceptionMessageWithCompositeRule()
    {
        $twitterUsernameValidator = Validator::noWhitespace()->alnum()->length(1,15);
        $validTwitterUser = 'augustohp';
        $notTwitterUsernameValidator = new Not($twitterUsernameValidator);
        $expectedMainMessage = 'These rules must not pass for "augustohp"';
        try {
            $notTwitterUsernameValidator->assert($validTwitterUser);
        } catch (Exceptions\ValidationException $e) {
            $this->assertEquals(
                $expectedMainMessage,
                $e->getMainMessage(),
                'Main exception message should be of a composite exception with multiple rules.'
            );
            /**
             * @TODO We should make that API valid.
            $this->assertEquals(
                $expectedMainMessage,
                $e->getMessage(),
                'The exception message should mimic the main exception message.'
            );
            */

            $this->assertInstanceOf(
                'Respect\Validation\Exceptions\AbstractNestedException',
                $e,
                'An exception from a composite rule should be an instance of Nested exception.'
            );

            $exceptionMessages = $e->getFullMessage();
            $this->assertContains(
                'must not not contain whitespace',
                $exceptionMessages,
                'The input does not have a whitespace, when negating the NoWhitespace rule this should fail and we should see that message.'
            );
            $this->assertContains(
                'must not contain letters',
                $exceptionMessages,
                'The input is an alnum string, when negating the AllNum rule this should fail and we should see that message.'
            );
            $this->assertContains(
                'must not have a length',
                $exceptionMessages,
                'The input has an ivalid length (for negated), when negating the Length rule this should fail and we should see that message.'
            );

            return 'This test must end here.';
        }

        $this->fail('An exception should be provoked and its message should have been checked.');
    }

    public function testAllRulesHaveANegativeTemplateOnException()
    {
        $this->markTestIncomplete('Create this test (re-use exception rule finding on exception testing)');
    }
}
