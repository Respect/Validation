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
use Respect\Validation\Test\Stubs\CountableStub;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\LessThan
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LessThanTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new LessThan(10), 9],
            [new LessThan('2010-01-01'), '2000-01-01'],
            [new LessThan('today'), '3 days ago'],
            [new LessThan('b'), 'a'],
            [new LessThan(new CountableStub(5)), 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new LessThan(10), 10],
            [new LessThan('2010-01-01'), '2020-01-01'],
            [new LessThan('yesterday'), 'tomorrow'],
            [new LessThan('a'), 'z'],
            [new LessThan(new CountableStub(5)), 6],
        ];
    }
}
