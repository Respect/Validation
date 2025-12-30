<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SimpleXMLElement;
use stdClass;

#[Group(' rule')]
#[CoversClass(ArrayVal::class)]
final class ArrayValTest extends RuleTestCase
{
    /** @return iterable<array{ArrayVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new ArrayVal();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, new ArrayObject()],
            [$rule, new SimpleXMLElement('<foo></foo>')],
        ];
    }

    /** @return iterable<array{ArrayVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new ArrayVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, new stdClass()],
            [$rule, false],
            [$rule, 'aaa'],
        ];
    }
}
