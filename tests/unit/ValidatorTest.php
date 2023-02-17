<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\TestCase;

/**
 * @covers \Respect\Validation\Validator
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class ValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function staticCreateShouldReturnNewValidator(): void
    {
        self::assertInstanceOf(Validator::class, Validator::create());
    }

    /**
     * @test
     */
    public function invalidRuleClassShouldThrowComponentException(): void
    {
        $this->expectException(ComponentException::class);
        Validator::iDoNotExistSoIShouldThrowException();
    }

    /**
     * Regression test #174.
     *
     * @test
     */
    public function shouldReturnValidatorInstanceWhenTheNotRuleIsCalledWithArguments(): void
    {
        $validator = new Validator();

        self::assertSame($validator, $validator->not($validator->notEmpty()));
    }
}
