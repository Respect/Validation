<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\WithMethods;
use stdClass;

use const INF;

#[Group('rule')]
#[CoversClass(CallableType::class)]
final class CallableTypeTest extends RuleTestCase
{
    /** @return iterable<array{CallableType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new CallableType();

        return [
            [$rule, static fn() => null],
            [$rule, 'trim'],
            [$rule, WithMethods::class . '::publicStaticMethod'],
            [$rule, [new WithMethods(), 'publicMethod']],
        ];
    }

    /** @return iterable<array{CallableType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new CallableType();

        return [
            [$rule, ' '],
            [$rule, INF],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
        ];
    }
}
