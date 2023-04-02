<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rules
 *
 * @covers \Respect\Validation\Rules\Sorted
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mikhail Vyrtsev <reeywhaar@gmail.com>
 */
final class SortedTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldNotAcceptWrongSortingDirection(): void
    {
        $this->expectExceptionObject(new ComponentException('Direction should be either "ASC" or "DESC"'));

        new Sorted('something');
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            'empty' => [new Sorted('ASC'), []],
            'one item' => [new Sorted('ASC'), [1]],
            'one character' => [new Sorted('ASC'), 'z'],
            'ASC array-sequence' => [new Sorted('ASC'), [1, 3, 5]],
            'ASC sequence in associative array' => [new Sorted('ASC'), ['foo' => 1, 'bar' => 3, 'baz' => 5]],
            'ASC string-sequence' => [new Sorted('ASC'), 'ABCD'],
            'DESC array-sequence ' => [new Sorted('DESC'), [10, 9, 8]],
            'DESC string-sequence ' => [new Sorted('DESC'), 'zyx'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            'duplicate' => [new Sorted('ASC'), [1, 1, 1]],
            'wrong ASC array-sequence' => [new Sorted('ASC'), [1, 3, 2]],
            'wrong ASC string-sequence' => [new Sorted('ASC'), 'xzy'],
            'wrong DESC array-sequence' => [new Sorted('DESC'), [1, 3, 2]],
            'wrong DESC string-sequence' => [new Sorted('DESC'), 'jml'],
            'DESC array-sequence with ASC validation' => [new Sorted('ASC'), [3, 2, 1]],
            'DESC string-sequence with ASC validation' => [new Sorted('ASC'), '321'],
            'ASC array-sequence with DESC validation' => [new Sorted('DESC'), [1, 2, 3]],
            'ASC string-sequence with DESC validation' => [new Sorted('DESC'), 'abc'],
            'unsupported value (integer)' => [new Sorted('DESC'), 1 ],
            'unsupported value (float)' => [new Sorted('DESC'), 1.2 ],
            'unsupported value (bool)' => [new Sorted('DESC'), true ],
            'unsupported value (object)' => [new Sorted('DESC'), new stdClass() ],
        ];
    }
}
