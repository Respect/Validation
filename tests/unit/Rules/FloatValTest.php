<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(FloatVal::class)]
final class FloatValTest extends RuleTestCase
{
    /** @return iterable<array{FloatVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new FloatVal();

        return [
            [$rule, 165],
            [$rule, 1],
            [$rule, 0],
            [$rule, 0.0],
            [$rule, '1'],
            [$rule, '19347e12'],
            [$rule, 165.0],
            [$rule, '165.7'],
            [$rule, 1e12],
        ];
    }

    /** @return iterable<array{FloatVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new FloatVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}
