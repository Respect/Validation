<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Spaced::class)]
final class SpacedTest extends RuleTestCase
{
    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Spaced();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 0],
            [$rule, 'wpoiur'],
            [$rule, 'Foo'],
            [$rule, []],
            [$rule, new stdClass()],
        ];
    }

    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Spaced();

        return [
            [$rule, ' '],
            [$rule, 'w poiur'],
            [$rule, '      '],
            [$rule, "Foo\nBar"],
            [$rule, "Foo\tBar"],
        ];
    }
}
