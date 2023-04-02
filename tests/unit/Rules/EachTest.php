<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NestedValidationException;
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
     * @test
     */
    public function itShouldNotOverrideMessages(): void
    {
        $rule = new Each(new StringType());
        try {
            $rule->assert([1, 2, 3]);
        } catch (NestedValidationException $e) {
            $this->assertEquals(
                $e->getMessages(),
                [
                    'stringType.0' => '1 must be of type string',
                    'stringType.1' => '2 must be of type string',
                    'stringType.2' => '3 must be of type string',
                ]
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Each(new AlwaysValid());

        return [
            [$rule, []],
            [$rule, [1, 2, 3, 4, 5]],
            [$rule, self::createTraversableInput(1, 5)],
            [$rule, self::createStdClassInput(1, 5)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Each(new AlwaysInvalid());

        return [
            [$rule, 123],
            [$rule, ''],
            [$rule, null],
            [$rule, false],
            [$rule, ['', 2, 3, 4, 5]],
            [$rule, ['a', 2, 3, 4, 5]],
            [$rule, self::createTraversableInput(1, 5)],
            [$rule, self::createStdClassInput(1, 5)],
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
        $input = [];
        foreach (range($firstValue, $lastValue) as $value) {
            $input[] = $value;
        }

        return (object) $input;
    }
}
