<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

use function rand;

#[Group('rule')]
#[CoversClass(Circuit::class)]
final class CircuitTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldValidateInputWhenAllRulesValidatesTheInput(mixed $input): void
    {
        self::assertValidInput(new Circuit(Stub::pass(1), Stub::pass(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForFailingRules')]
    public function itShouldExecuteRulesInSequenceUntilOneFails(Stub ...$stub): void
    {
        $rule = new Circuit(...$stub);

        self::assertInvalidInput($rule, rand());
    }

    #[Test]
    public function itShouldReturnTheResultOfTheFailingRule(): void
    {
        $input = rand();

        $rule = new Circuit(Stub::fail(1), Stub::daze());

        $actual = $rule->evaluate($input);
        $expected = Stub::fail(1)->evaluate($input);

        self::assertEquals($expected, $actual);
    }

    /** @return array<array<Stub>> */
    public static function providerForFailingRules(): array
    {
        return [
            'first fails' => [Stub::fail(1), Stub::daze()],
            'second fails' => [Stub::pass(1), Stub::fail(1), Stub::daze()],
            'third fails' => [Stub::pass(1), Stub::fail(1), Stub::fail(1), Stub::daze(), Stub::daze()],
        ];
    }
}
