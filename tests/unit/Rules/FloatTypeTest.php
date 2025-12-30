<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(FloatType::class)]
final class FloatTypeTest extends RuleTestCase
{
    /** @return iterable<array{FloatType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new FloatType();

        return [
            [$rule, 165.23],
            [$rule, 1.3e3],
            [$rule, 7E-10],
            [$rule, 0.0],
            [$rule, -2.44],
            [$rule, 10 / 33.33],
            [$rule, PHP_INT_MAX + 1],
        ];
    }

    /** @return iterable<array{FloatType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new FloatType();

        return [
            [$rule, '1'],
            [$rule, '1.0'],
            [$rule, '7E-10'],
            [$rule, 111111],
            [$rule, PHP_INT_MAX * -1],
        ];
    }
}
