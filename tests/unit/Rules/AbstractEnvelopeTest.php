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
use Respect\Validation\Validatable;

/**
 * @test core
 *
 * @covers \Respect\Validation\Rules\AbstractEnvelope
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractEnvelopeTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldValidateUsingTheInnerRule(): void
    {
        $input = 'value';

        $innerRule = $this->createMock(Validatable::class);
        $innerRule
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->willReturn(true);

        $rule = $this->getMockForAbstractClass(AbstractEnvelope::class, [$innerRule, []]);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $input = 'value';

        $innerRule = $this->createMock(Validatable::class);
        $innerRule
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->willReturn(false);

        $rule = $this->getMockForAbstractClass(AbstractEnvelope::class, [$innerRule, []]);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @test
     */
    public function itShouldReportErrorUringProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $rule = $this->getMockForAbstractClass(
            AbstractEnvelope::class,
            [$this->createMock(Validatable::class), $parameters]
        );

        $exception = $rule->reportError($input);

        self::assertArraySubset($parameters, $exception->getParams());
    }
}
