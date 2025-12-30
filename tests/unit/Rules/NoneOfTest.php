<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(NoneOf::class)]
final class NoneOfTest extends RuleTestCase
{
    /** @return iterable<string, array{NoneOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{NoneOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'pass, fail' => [new NoneOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, pass, fail' => [new NoneOf(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, pass' => [new NoneOf(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }
}
