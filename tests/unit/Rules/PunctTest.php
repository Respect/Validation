<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Punct::class)]
final class PunctTest extends RuleTestCase
{
    /** @return iterable<array{Punct, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Punct();

        return [
            [$sut, '.'],
            [$sut, ',;:'],
            [$sut, '-@#$*'],
            [$sut, '()[]{}'],
            [new Punct('abc123 '), '!@#$%^&*(){} abc 123'],
            [new Punct("abc123 \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /** @return iterable<array{Punct, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Punct();

        return [
            [$sut, ''],
            [$sut, '16-50'],
            [$sut, 'a'],
            [$sut, ' '],
            [$sut, 'Foo'],
            [$sut, '12.1'],
            [$sut, '-12'],
            [$sut, -12],
            [$sut, '( )_{}'],
        ];
    }
}
