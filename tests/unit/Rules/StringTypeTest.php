<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(StringType::class)]
final class StringTypeTest extends RuleTestCase
{
    /** @return iterable<array{StringType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new StringType();

        return [
            [$rule, ''],
            [$rule, '165.7'],
        ];
    }

    /** @return iterable<array{StringType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new StringType();

        return [
            [$rule, null],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 150],
        ];
    }
}
