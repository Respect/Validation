<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Sf
 * @covers \Respect\Validation\Exceptions\SfException
 */
class SfTest extends TestCase
{
    public function testValidationWithAnExistingValidationConstraint(): void
    {
        $constraintName = 'Time';
        $validConstraintValue = '04:20:00';
        $invalidConstraintValue = 'yada';
        self::assertTrue(
            v::sf($constraintName)->validate($validConstraintValue),
            sprintf('"%s" should be valid under "%s" constraint.', $validConstraintValue, $constraintName)
        );
        self::assertFalse(
            v::sf($constraintName)->validate($invalidConstraintValue),
            sprintf('"%s" should be invalid under "%s" constraint.', $invalidConstraintValue, $constraintName)
        );
    }

    /**
     * @depends testValidationWithAnExistingValidationConstraint
     */
    public function testAssertionWithAnExistingValidationConstraint(): void
    {
        $constraintName = 'Time';
        $validConstraintValue = '04:20:00';
        self::assertTrue(
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
        } catch (AllOfException $exception) {
            $fullValidationMessage = $exception->getFullMessage();
            $expectedValidationException = <<<'EOF'
- Time
EOF;

            return self::assertEquals(
                $expectedValidationException,
                $fullValidationMessage,
                'Exception message is different from the one expected.'
            );
        }
        $this->fail('Validation exception expected to compare message.');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Symfony/Validator constraint "FluxCapacitor" does not exist.
     */
    public function testValidationWithNonExistingConstraint(): void
    {
        $fantasyConstraintName = 'FluxCapacitor';
        $fantasyValue = '8GW';
        v::sf($fantasyConstraintName)->validate($fantasyValue);
    }
}
