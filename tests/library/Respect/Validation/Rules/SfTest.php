<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator as v;

class SfTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        if (false === class_exists('Symfony\Component\Validator\Constraints\Time')) {
            $this->markTestSkipped('Expected Symfony\Validator installed.');
        }
    }

    public function testValidationWithAnExistingValidationConstraint()
    {
        $constraintName = 'Time';
        $validConstraintValue = '04:20:00';
        $invalidConstraintValue = 'yada';
        $rule = new Sf($constraintName);
        $this->assertTrue(
            $rule->validate($validConstraintValue),
            sprintf('"%s" should be valid under "%s" constraint.', $validConstraintValue, $constraintName)
        );
        $this->assertFalse(
            $rule->validate($invalidConstraintValue),
            sprintf('"%s" should be invalid under "%s" constraint.', $invalidConstraintValue, $constraintName)
        );
    }

    /**
     * @depends testValidationWithAnExistingValidationConstraint
     */
    public function testAssertionWithAnExistingValidationConstraint()
    {
        $constraintName = 'Time';
        $validConstraintValue = '04:20:00';
        $rule = new Sf($constraintName);
        $this->assertTrue(
            $rule->assert($validConstraintValue),
            sprintf('"%s" should be valid under "%s" constraint.', $validConstraintValue, $constraintName)
        );
    }

    /**
     * @depends testAssertionWithAnExistingValidationConstraint
     */
    public function testAssertionMessageWithAnExistingValidationConstraint()
    {
        $constraintName = 'Time';
        $invalidConstraintValue = '34:90:70';
        $rule = new AllOf(new Sf($constraintName));
        try {
            $rule->assert($invalidConstraintValue);
        } catch (\Respect\Validation\Exceptions\AllOfException $exception) {
            $fullValidationMessage = $exception->getFullMessage();
            $expectedValidationException = <<<EOF
\-These rules must pass for "34:90:70"
  \-Time
EOF;
            return $this->assertEquals(
                $expectedValidationException,
                $fullValidationMessage,
                'Exception message is different from the one expected.'
            );
        }
        $this->fail('Validation exception expected to compare message.');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Symfony/Validator constraint "FluxCapacitor" does not exist.
     */
    public function testValidationWithNonExistingConstraint()
    {
        $fantasyConstraintName = 'FluxCapacitor';
        $rule = new Sf($fantasyConstraintName);
        $fantasyValue = '8GW';
        $rule->validate($fantasyValue);
    }
}
