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

use DateTime;
use DateTimeImmutable;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractComparison
 * @covers \Respect\Validation\Rules\Max
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MaxTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Max(10), 9],
            [new Max(10), 10],
            [new Max('2010-01-01'), '2000-01-01'],
            [new Max(new DateTime('today')), new DateTimeImmutable('yesterday')],
            [new Max('18 years ago'), '1988-09-09'],
            [new Max('z'), 'a'],
            [new Max(new CountableStub(3)), 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Max(10), 11],
            [new Max(new DateTimeImmutable('today')), new DateTime('tomorrow')],
            [new Max('now'), '+1 minute'],
            [new Max('B'), 'C'],
            [new Max(new CountableStub(3)), 4],
            [new Max(1900), '2018-01-25'],
            [new Max(10.5), '2018-01-25'],
        ];
    }
}
