<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

#[Group('rule')]
#[CoversClass(ScalarVal::class)]
final class ScalarValTest extends RuleTestCase
{
    /** @return iterable<array{ScalarVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new ScalarVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
        ];
    }

    /** @return iterable<array{ScalarVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new ScalarVal();

        return [
            [$rule, []],
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}
