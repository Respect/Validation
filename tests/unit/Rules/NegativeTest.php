<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Negative::class)]
final class NegativeTest extends RuleTestCase
{
    /** @return iterable<array{Negative, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Negative();

        return [
            [$rule, '-1.44'],
            [$rule, -1e-5],
            [$rule, -10],
        ];
    }

    /** @return iterable<array{Negative, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Negative();

        return [
            [$rule, ''],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 0],
            [$rule, -0],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, 1e10],
        ];
    }
}
