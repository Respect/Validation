<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Blank::class)]
final class BlankTest extends RuleTestCase
{
    /** @return iterable<array{Blank, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $object = new stdClass();
        $object->foo = true;

        $rule = new Blank();

        return [
            [$rule, 1],
            [$rule, ' oi'],
            [$rule, [5]],
            [$rule, [1]],
            [$rule, $object],
        ];
    }

    /** @return iterable<array{Blank, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Blank();

        return [
            [$rule, null],
            [$rule, ''],
            [$rule, []],
            [$rule, ' '],
            [$rule, 0],
            [$rule, '0'],
            [$rule, 0],
            [$rule, '0.0'],
            [$rule, false],
            [$rule, ['']],
            [$rule, [' ']],
            [$rule, [0]],
            [$rule, ['0']],
            [$rule, [false]],
            [$rule, [[''], [0]]],
            [$rule, new stdClass()],
        ];
    }
}
