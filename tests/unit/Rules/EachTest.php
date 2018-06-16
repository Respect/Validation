<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;
use SplStack;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Each
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EachTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Each($this->createValidatableMock(true));

        return [
            [$rule, []],
            [$rule, [1, 2, 3, 4, 5]],
        ];
    }

    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * @test
     */
    public function itShouldValidateTraversable(): void
    {
        $validatable = $this->createMock(Validatable::class);

        $validatable
            ->expects($this->at(0))
            ->method('check')
            ->with('A');
        $validatable
            ->expects($this->at(1))
            ->method('check')
            ->with('B');
        $validatable
            ->expects($this->at(2))
            ->method('check')
            ->with('C');

        $rule = new Each($validatable);

        $input = new SplStack();
        $input->push('C');
        $input->push('B');
        $input->push('A');

        self::assertValidInput($rule, $input);
    }

    /**
     * @test
     */
    public function itShouldValidateStdClass(): void
    {
        $validatable = $this->createMock(Validatable::class);

        $validatable
            ->expects($this->at(0))
            ->method('check')
            ->with(1);
        $validatable
            ->expects($this->at(1))
            ->method('check')
            ->with(2);
        $validatable
            ->expects($this->at(2))
            ->method('check')
            ->with(3);

        $rule = new Each($validatable);

        $input = new stdClass();
        $input->foo = 1;
        $input->bar = 2;
        $input->baz = 3;

        self::assertValidInput($rule, $input);
    }
}
