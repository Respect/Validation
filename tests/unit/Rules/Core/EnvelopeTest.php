<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Core\ConcreteEnvelope;
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
        $rule = new ConcreteEnvelope(Stub::pass(1), []);

        self::assertTrue($rule->evaluate('something')->hasPassed);
    }

    #[Test]
    public function itShouldInvalidateUsingTheInnerRule(): void
    {
        $rule = new ConcreteEnvelope(Stub::fail(1), []);

        self::assertFalse($rule->evaluate('something')->hasPassed);
    }

    #[Test]
    public function itShouldEvaluatePassingTheGivenProperties(): void
    {
        $input = 'value';
        $parameters = ['foo' => true, 'bar' => false, 'baz' => 42];

        $rule = new ConcreteEnvelope(Stub::fail(1), $parameters);
        $result = $rule->evaluate($input);

        self::assertEquals($parameters, array_intersect_key($parameters, $result->parameters));
    }
}
