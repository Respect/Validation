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
        $this->assertTrue(
            v::sf($constraintName)->validate($validConstraintValue),
            sprintf('"%s" should be valid under "%s" constraint.', $validConstraintValue, $constraintName)
        );
        $this->assertFalse(
            v::sf($constraintName)->validate($invalidConstraintValue),
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
        $this->assertTrue(
            v::sf($constraintName)->assert($validConstraintValue),
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
        try {
            v::sf($constraintName)->assert($invalidConstraintValue);
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
        $fantasyValue = '8GW';
        v::sf($fantasyConstraintName)->validate($fantasyValue);
    }
}
