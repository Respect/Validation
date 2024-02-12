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
use Respect\Validation\Test\Rules\EnvelopStub;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

use function array_intersect_key;

#[Group('core')]
#[CoversClass(Envelope::class)]
final class EnvelopeTest extends TestCase
{
    #[Test]
    public function itShouldValidateUsingTheInnerRule(): void
    {
        $rule = new EnvelopStub(Stub::pass(1), []);

        self::assertTrue($rule->evaluate('something')->isValid);
    }

    #[Test]
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $rule = new EnvelopStub(Stub::fail(1), []);

        self::assertFalse($rule->evaluate('something')->isValid);
    }

    #[Test]
    public function itShouldEvaluatePassingTheGivenProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $rule = new EnvelopStub(Stub::fail(1), $parameters);
        $result = $rule->evaluate($input);

        self::assertEquals($parameters, array_intersect_key($parameters, $result->parameters));
    }
}
