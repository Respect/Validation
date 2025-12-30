<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Digit::class)]
final class DigitTest extends RuleTestCase
{
    /** @return iterable<array{Digit, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'positive integer' => [new Digit(), 165],
            'positive string-integer' => [new Digit(), '01650'],
            'positive string-integer with one exception' => [new Digit('-'), '16-50'],
            'positive string-integer with multiple exceptions' => [new Digit('.-'), '16-5.0'],
            'only exceptions' => [new Digit('!@#$%^&*(){}'), '!@#$%^&*(){}'],
            'multiple exceptions' => [new Digit('.', '-'), '012.071.070-69'],
            'float' => [new Digit(), 1.0],
            'boolean true' => [new Digit(), true],
            'octal' => [new Digit(), 01],
            'string-octal' => [new Digit(), '01'],
        ];
    }

    /** @return iterable<array{Digit, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'empty' => [new Digit(), ''],
            'with spaces' => [new Digit(), '16 50'],
            'with tabs' => [new Digit(), "1\t1"],
            'with newlines' => [new Digit(), "1\n1"],
            'null' => [new Digit(), null],
            'with non-numeric' => [new Digit(), '16-50'],
            'alphabetic' => [new Digit(), 'a'],
            'alphanumeric' => [new Digit(), 'a1'],
            'negative integer' => [new Digit(), -12],
            'negative string-integer' => [new Digit(), '-12'],
            'float-string' => [new Digit(), '1.0'],
            'negative float' => [new Digit(), -1.1],
            'negative string-float' => [new Digit(), '-1.1'],
            'boolean false' => [new Digit(), false],
        ];
    }
}
