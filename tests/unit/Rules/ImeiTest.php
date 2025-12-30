<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Imei::class)]
final class ImeiTest extends RuleTestCase
{
    /** @return iterable<array{Imei, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Imei();

        return [
            [$rule, '35-007752-323751-3'],
            [$rule, '35-209900-176148-1'],
            [$rule, '350077523237513'],
            [$rule, '356938035643809'],
            [$rule, '490154203237518'],
            [$rule, 350077523237513],
            [$rule, 356938035643809],
            [$rule, 490154203237518],
        ];
    }

    /** @return iterable<array{Imei, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Imei();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 1.0],
            [$rule, new stdClass()],
            [$rule, '490154203237512'],
            [$rule, '4901542032375125'],
            [$rule, 'Whateveeeeeerrr'],
            [$rule, true],
        ];
    }
}
