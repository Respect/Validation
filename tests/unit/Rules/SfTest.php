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
 * @covers \Respect\Validation\Exceptions\SfException
 * @covers \Respect\Validation\Rules\Sf
 */
class SfTest extends TestCase
{
    /**
     * @test
     */
    public function validationWithAnExistingValidationConstraint(): void
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
     * @doesNotPerformAssertions
     *
     * @depends validationWithAnExistingValidationConstraint
     *
     * @test
     */
    public function assertionWithAnExistingValidationConstraint(): void
    {
        $constraintName = 'Time';
        $validConstraintValue = '04:20:00';
        v::sf($constraintName)->assert($validConstraintValue);
    }

    /**
     * @depends assertionWithAnExistingValidationConstraint
     *
     * @test
     */
    public function assertionMessageWithAnExistingValidationConstraint()
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
        self::fail('Validation exception expected to compare message.');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Symfony/Validator constraint "FluxCapacitor" does not exist.
     *
     * @test
     */
    public function validationWithNonExistingConstraint(): void
    {
        $fantasyConstraintName = 'FluxCapacitor';
        $fantasyValue = '8GW';
        v::sf($fantasyConstraintName)->validate($fantasyValue);
    }
}
