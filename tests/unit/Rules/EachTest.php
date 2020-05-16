<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
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
            ->expects(self::at(0))
            ->method('assert')
            ->with(1);
        $validatable
            ->expects(self::at(1))
            ->method('assert')
            ->with(2);
        $validatable
            ->expects(self::at(2))
            ->method('assert')
            ->with(3);

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
            ->expects(self::at(0))
            ->method('check')
            ->with(1);
        $validatable
            ->expects(self::at(1))
            ->method('check')
            ->with(2);
        $validatable
            ->expects(self::at(2))
            ->method('check')
            ->with(3);

        $rule = new Each($validatable);
        $rule->check(range(1, 3));
    }

    private function createTraversableInput(int $firstValue, int $lastValue): Traversable
    {
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
