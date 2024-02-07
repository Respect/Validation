<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;
use SplStack;
use stdClass;
use Traversable;

use function array_chunk;
use function range;

#[Group('rule')]
#[CoversClass(Each::class)]
final class EachTest extends RuleTestCase
{
    #[Test]
    public function itShouldAssertEachValue(): void
    {
        $rule = Stub::pass(3);

        $inputs = range(1, 3);

        $sut = new Each($rule);
        $sut->assert($inputs);

        self::assertSame($inputs, $rule->inputs);
    }

    #[Test]
    public function itShouldCheckEachValue(): void
    {
        $rule = Stub::pass(3);

        $inputs = range(1, 3);

        $sut = new Each($rule);
        $sut->check($inputs);

        self::assertSame($inputs, $rule->inputs);
    }

    #[Test]
    public function itShouldNotOverrideMessages(): void
    {
        $rule = new Each(Stub::fail(3));
        try {
            $rule->assert([1, 2, 3]);
        } catch (NestedValidationException $e) {
            $this->assertEquals(
                $e->getMessages(),
                [
                    'stub.0' => '1 must be a valid stub',
                    'stub.1' => '2 must be a valid stub',
                    'stub.2' => '3 must be a valid stub',
                ]
            );
        }
    }

    /** @return iterable<array{Each, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Each(Stub::daze()), []],
            [new Each(Stub::pass(5)), [1, 2, 3, 4, 5]],
            [new Each(Stub::pass(5)), self::createTraversableInput(1, 5)],
            [new Each(Stub::pass(5)), self::createStdClassInput(1, 5)],
        ];
    }

    /** @return iterable<array{Each, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Each(Stub::daze()), 123],
            [new Each(Stub::daze()), ''],
            [new Each(Stub::daze()), null],
            [new Each(Stub::daze()), false],
            [new Each(Stub::fail(5)), ['', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), ['a', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), self::createTraversableInput(1, 5)],
            [new Each(Stub::fail(5)), self::createStdClassInput(1, 5)],
        ];
    }

    /**
     * @return Traversable<int>
     */
    private static function createTraversableInput(int $firstValue, int $lastValue): Traversable
    {
        /** @var SplStack<int> */
        $input = new SplStack();
        foreach (range($firstValue, $lastValue) as $value) {
            $input->push($value);
        }

        return $input;
    }

    private static function createStdClassInput(int $firstValue, int $lastValue): stdClass
    {
        return (object) array_chunk(range($firstValue, $lastValue), 1);
    }
}
