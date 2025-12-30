<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(IterableVal::class)]
final class IterableValTest extends RuleTestCase
{
    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new IterableVal();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new stdClass()],
            [$rule, new ArrayIterator()],
        ];
    }

    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new IterableVal();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
