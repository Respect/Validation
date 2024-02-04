<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Envelop;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

use function array_intersect_key;

#[Group('core')]
#[CoversClass(AbstractEnvelope::class)]
final class AbstractEnvelopeTest extends TestCase
{
    #[Test]
    public function itShouldValidateUsingTheInnerRule(): void
    {
        $rule = new Envelop(Stub::pass(1), []);

        self::assertTrue($rule->validate('something'));
    }

    #[Test]
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $rule = new Envelop(Stub::fail(1), []);

        self::assertFalse($rule->validate('something'));
    }

    #[Test]
    public function itShouldReportErrorUsingProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $rule = new Envelop(Stub::fail(1), $parameters);
        $exception = $rule->reportError($input);

        self::assertEquals($parameters, array_intersect_key($parameters, $exception->getParams()));
    }
}
