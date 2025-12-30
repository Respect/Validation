<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function acos;
use function sqrt;

use const INF;
use const NAN;
use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(Number::class)]
final class NumberTest extends RuleTestCase
{
    /** @return iterable<array{Number, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Number();

        return [
            [$rule, '42'],
            [$rule, 123456],
            [$rule, 0.00000000001],
            [$rule, '0.5'],
            [$rule, PHP_INT_MAX],
            [$rule, -PHP_INT_MAX],
            [$rule, INF],
            [$rule, -INF],
        ];
    }

    /** @return iterable<array{Number, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Number();

        return [
            [$rule, acos(1.01)],
            [$rule, sqrt(-1)],
            [$rule, NAN],
            [$rule, -NAN],
            [$rule, false],
            [$rule, true],
            [$rule, []],
            [$rule, new stdClass()],
        ];
    }
}
