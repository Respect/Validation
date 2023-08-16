<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

use function array_intersect_key;

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
            ->expects(self::once())
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
            ->expects(self::once())
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

        self::assertEquals($parameters, array_intersect_key($parameters, $exception->getParams()));
    }
}
