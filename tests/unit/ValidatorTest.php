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

namespace Respect\Validation;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ComponentException;

/**
 * @covers \Respect\Validation\Validator
 */
class ValidatorTest extends TestCase
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
