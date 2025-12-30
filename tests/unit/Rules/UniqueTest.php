<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Unique::class)]
final class UniqueTest extends RuleTestCase
{
    /** @return iterable<array{Unique, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Unique();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, [true, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta']],
            [$rule, [0, 2.71, 3.14]],
            [$rule, [[], ['str'], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['other_key' => 'value']]],
        ];
    }

    /** @return iterable<array{Unique, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Unique();

        return [
            [$rule, 'test'],
            [$rule, [1, 2, 2, 3]],
            [$rule, [1, 2, 3, 1]],
            [$rule, [true, false, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta', 'beta']],
            [$rule, [0, 3.14, 2.71, 3.14]],
            [$rule, [[], [1], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['key' => 'value']]],
            [$rule, [1, true, 'test']], // PHP's array_unique treats 1 and true as equal
        ];
    }
}
