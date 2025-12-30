<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(EndsWith::class)]
final class EndsWithTest extends RuleTestCase
{
    /** @return iterable<array{EndsWith, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new EndsWith('foo'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barbazFOO'],
            [new EndsWith('foo'), 'barbazfoo'],
            [new EndsWith('foo'), 'foobazfoo'],
            [new EndsWith('1'), [2, 3, 1]],
            [new EndsWith(1), [2, 3, 1]],
            [new EndsWith('1', true), [2, 3, '1']],
        ];
    }

    /** @return iterable<array{EndsWith, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new EndsWith('foo'), ''],
            [new EndsWith('bat'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barfaabaz'],
            [new EndsWith('foo', true), 'barbazFOO'],
            [new EndsWith('foo'), 'faabarbaz'],
            [new EndsWith('foo'), 'baabazfaa'],
            [new EndsWith('foo'), 'baafoofaa'],
            [new EndsWith('1', true), [1, '1', 3]],
        ];
    }
}
