<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(TrueVal::class)]
final class TrueValTest extends RuleTestCase
{
    /** @return iterable<array{TrueVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new TrueVal();

        return [
            [$rule, true],
            [$rule, 1],
            [$rule, '1'],
            [$rule, 'true'],
            [$rule, 'on'],
            [$rule, 'yes'],
            [$rule, 'TRUE'],
            [$rule, 'ON'],
            [$rule, 'YES'],
            [$rule, 'True'],
            [$rule, 'On'],
            [$rule, 'Yes'],
        ];
    }

    /** @return iterable<array{TrueVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new TrueVal();

        return [
            [$rule, false],
            [$rule, 0],
            [$rule, 0.5],
            [$rule, 2],
            [$rule, '0'],
            [$rule, 'false'],
            [$rule, 'off'],
            [$rule, 'no'],
            [$rule, 'truth'],
        ];
    }
}
