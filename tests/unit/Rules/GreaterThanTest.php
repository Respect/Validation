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
 * @covers \Respect\Validation\Rules\GreaterThan
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GreaterThanTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new GreaterThan(10), 11],
            [new GreaterThan('2010-01-01'), '2020-01-01'],
            [new GreaterThan('yesterday'), 'now'],
            [new GreaterThan('A'), 'B'],
            [new GreaterThan(new CountableStub(3)), 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new GreaterThan(10), 9],
            [new GreaterThan('2010-01-01'), '2000-01-01'],
            [new GreaterThan('18 years ago'), '5 days later'],
            [new GreaterThan('c'), 'a'],
            [new GreaterThan(new CountableStub(3)), 3],
        ];
    }
}
