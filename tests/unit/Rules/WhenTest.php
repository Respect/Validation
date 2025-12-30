<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

use function rand;

#[Group('rule')]
#[CoversClass(When::class)]
final class WhenTest extends RuleTestCase
{
    /** @return array<array{When, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'when fail, then pass' => [new When(Stub::pass(1), Stub::pass(1)), rand()],
            'when pass, then pass, else daze' => [new When(Stub::pass(1), Stub::pass(1), Stub::daze()), rand()],
            'when fail, then daze, else pass' => [new When(Stub::fail(1), Stub::daze(), Stub::pass(1)), rand()],
        ];
    }

    /** @return array<array{When, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'when pass, then fail' => [new When(Stub::pass(1), Stub::fail(1)), rand()],
            'when pass, then fail, else daze' => [new When(Stub::pass(1), Stub::fail(1), Stub::daze()), rand()],
            'when fail, then daze, else fail' => [new When(Stub::fail(1), Stub::daze(), Stub::fail(1)), rand()],
        ];
    }
}
