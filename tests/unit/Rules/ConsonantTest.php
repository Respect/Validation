<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Consonant::class)]
final class ConsonantTest extends RuleTestCase
{
    /** @return iterable<array{Consonant, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $consonant = new Consonant();

        return [
            'Letter "b"' => [$consonant, 'b'],
            'Letter "c"' => [$consonant, 'c'],
            'Letter "d"' => [$consonant, 'd'],
            'Letter "w"' => [$consonant, 'w'],
            'Letter "y"' => [$consonant, 'y'],
            'String "bcdfghklmnp"' => [$consonant, 'bcdfghklmnp'],
            'String with space in the middle "bcdfghklm np"' => [$consonant, 'bcdfghklm np'],
            'String "qrst"' => [$consonant, 'qrst'],
            'String with cntrl "\nz\t"' => [$consonant, "\nz\t"],
            'String "zbcxwyrspq"' => [$consonant, 'zbcxwyrspq'],
            'Ignoring characters "!@#$%^&*(){}"' => [new Consonant('!@#$%^&*(){}'), '!@#$%^&*(){} bc dfg'],
            'Ignoring characters "[]?+=/\\-_|"\',<>."' => [
                new Consonant('[]?+=/\\-_|"\',<>.'),
                "[]?+=/\\-_|\"',<>. \t \n bc dfg",
            ],
        ];
    }

    /** @return iterable<array{Consonant, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $consonant = new Consonant();

        return [
            'Parameter empty' => [$consonant, ''],
            'Letter "a"' => [$consonant, 'a'],
            'Parameter "null"' => [$consonant, null],
            'Number "16"' => [$consonant, '16'],
            'Alphabet "aeiou"' => [$consonant, 'aeiou'],
            'String "Foo"' => [$consonant, 'Foo'],
            'Negative integer "-50"' => [$consonant, -50],
            'String "basic"' => [$consonant, 'basic'],
            'Array empty' => [$consonant, []],
            'Integer' => [$consonant, 10],
            'Instance stdClass' => [$consonant, new stdClass()],
        ];
    }
}
