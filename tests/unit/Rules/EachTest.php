<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;
use SplStack;
use stdClass;
use Traversable;

use function range;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Each
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EachTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Each($this->createValidatableMock(true));

        return [
            [$rule, []],
            [$rule, [1, 2, 3, 4, 5]],
            [$rule, $this->createTraversableInput(1, 5)],
            [$rule, $this->createStdClassInput(1, 5)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Each($this->createValidatableMock(false));

        return [
            [$rule, 123],
            [$rule, ''],
            [$rule, null],
            [$rule, false],
            [$rule, ['', 2, 3, 4, 5]],
            [$rule, ['a', 2, 3, 4, 5]],
            [$rule, $this->createTraversableInput(1, 5)],
            [$rule, $this->createStdClassInput(1, 5)],
        ];
    }

    /**
     * @test
     */
    public function itShouldAssertEachValue(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::exactly(3))
            ->method('assert')
            ->will($this->onConsecutiveCalls([1], [2], [3]));

        $rule = new Each($validatable);
        $rule->assert(range(1, 3));
    }

    /**
     * @test
     */
    public function itShouldCheckEachValue(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::exactly(3))
            ->method('check')
            ->will($this->onConsecutiveCalls([1], [2], [3]));

        $rule = new Each($validatable);
        $rule->check(range(1, 3));
    }

    /**
     * @return Traversable<int>
     */
    private function createTraversableInput(int $firstValue, int $lastValue): Traversable
    {
        /** @var SplStack<int> */
        $input = new SplStack();
        foreach (range($firstValue, $lastValue) as $value) {
            $input->push($value);
        }

        return $input;
    }

    private function createStdClassInput(int $firstValue, int $lastValue): stdClass
    {
        $input = [];
        foreach (range($firstValue, $lastValue) as $value) {
            $input[] = $value;
        }

        return (object) $input;
    }
}
