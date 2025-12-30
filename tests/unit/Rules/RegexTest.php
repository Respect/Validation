<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Regex::class)]
final class RegexTest extends RuleTestCase
{
    /** @return iterable<array{Regex, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Regex('/^[a-z]+$/'), 'wpoiur'],
            [new Regex('/^[a-z]+$/i'), 'wPoiur'],
            [new Regex('/^[0-9]+$/i'), 42],
        ];
    }

    /** @return iterable<array{Regex, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Regex('/^w+$/'), 'w poiur'],
            [new Regex('/^w+$/'), new stdClass()],
            [new Regex('/^w+$/'), []],
        ];
    }
}
