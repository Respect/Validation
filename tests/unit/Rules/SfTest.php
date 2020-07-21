<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\TestCase;
use stdClass;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\TraceableValidator;

use function class_exists;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Sf
 *
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SfTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldValidateWithDefinedConstraintAndValidator(): void
    {
        $sut = new Sf(new IsNull());

        self::assertTrue($sut->validate(null));
    }

    /**
     * @test
     */
    public function itShouldInvalidateWithDefinedConstraintAndValidator(): void
    {
        $sut = new Sf(new IsFalse());

        self::assertFalse($sut->validate(true));
    }

    /**
     * @test
     */
    public function itShouldUseTheDefinedValidatorToValidate(): void
    {
        if (!class_exists(TraceableValidator::class)) {
            self::markTestSkipped(
                'The current version of Symfony Validator does not have ' . TraceableValidator::class
            );
        }

        $input = new stdClass();

        $validator = new TraceableValidator(Validation::createValidator());

        $sut = new Sf(new IsNull(), $validator);
        $sut->validate($input);

        self::assertSame($input, $validator->getCollectedData()[0]['context']['value']);
    }
}
