<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Positive::class)]
final class PositiveTest extends RuleTestCase
{
    /** @return iterable<array{Positive, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Positive();

        return [
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, 1e10],
        ];
    }

    /** @return iterable<array{Positive, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Positive();

        return [
            [$rule, ''],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
            [$rule, '-1.44'],
            [$rule, -1e-5],
            [$rule, 0],
            [$rule, -0],
            [$rule, -10],
        ];
    }
}
