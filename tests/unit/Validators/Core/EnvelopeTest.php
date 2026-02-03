<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteEnvelope;
use Respect\Validation\Test\Validators\Stub;

use function array_intersect_key;

#[Group('core')]
#[CoversClass(Envelope::class)]
final class EnvelopeTest extends TestCase
{
    #[Test]
    public function itShouldValidateUsingTheInnerRule(): void
    {
        $validator = new ConcreteEnvelope(Stub::pass(1), []);

        self::assertTrue($validator->evaluate('something')->hasPassed);
    }

    #[Test]
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $validator = new ConcreteEnvelope(Stub::fail(1), []);

        self::assertFalse($validator->evaluate('something')->hasPassed);
    }

    #[Test]
    public function itShouldEvaluatePassingTheGivenProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $validator = new ConcreteEnvelope(Stub::fail(1), $parameters);
        $result = $validator->evaluate($input);

        self::assertEquals($parameters, array_intersect_key($parameters, $result->parameters));
    }
}
