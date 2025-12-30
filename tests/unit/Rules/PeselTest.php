<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Pesel::class)]
final class PeselTest extends RuleTestCase
{
    /** @return iterable<array{Pesel, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Pesel();

        return [
            [$rule, 0x4EADCD168], // 0x4EADCD168 === 21120209256
            [$rule, 49040501580],
            [$rule, '49040501580'],
            [$rule, '39012110375'],
            [$rule, '50083014540'],
            [$rule, '69090515504'],
            [$rule, '21120209256'],
            [$rule, '01320613891'],
        ];
    }

    /** @return iterable<array{Pesel, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Pesel();

        return [
            [$rule, null],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, '1'],
            [$rule, '22'],
            [$rule, 'PESEL'],
            [$rule, '0x4EADCD168'],
            [$rule, 'PESEL123456'],
            [$rule, '690905155.4'],
            [$rule, '21120209251'],
            [$rule, '21120209250'],
            [$rule, '01320613890'],
        ];
    }
}
