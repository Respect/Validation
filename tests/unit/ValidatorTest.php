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

class ValidatorTest extends TestCase
{
    public function testStaticCreateShouldReturnNewValidator(): void
    {
        self::assertInstanceOf(Validator::class, Validator::create());
    }

    public function testInvalidRuleClassShouldThrowComponentException(): void
    {
        $this->expectException(ComponentException::class);
        Validator::iDoNotExistSoIShouldThrowException();
    }

    /**
     * Regression test #174.
     */
    public function testShouldReturnValidatorInstanceWhenTheNotRuleIsCalledWithArguments(): void
    {
        $validator = new Validator();

        self::assertSame($validator, $validator->not($validator->notEmpty()));
    }
}
