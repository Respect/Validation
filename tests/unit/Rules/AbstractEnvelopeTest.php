<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\Rules\Envelop;
use Respect\Validation\Test\TestCase;

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
        $rule = new Envelop(new AlwaysValid(), []);

        self::assertTrue($rule->validate('something'));
    }

    /**
     * @test
     */
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $rule = new Envelop(new AlwaysInvalid(), []);

        self::assertFalse($rule->validate('something'));
    }

    /**
     * @test
     */
    public function itShouldReportErrorUsingProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $rule = new Envelop(new AlwaysInvalid(), $parameters);
        $exception = $rule->reportError($input);

        self::assertEquals($parameters, array_intersect_key($parameters, $exception->getParams()));
    }
}
