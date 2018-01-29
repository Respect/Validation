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

namespace Respect\Validation\Test\Rules;

use DateTime;
use DateTimeImmutable;
use Respect\Validation\Rules\MaximumAge;
use Respect\Validation\Test\RuleTestCase;
use stdClass;
use function date;
use function strtotime;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\MaximumAge
 * @covers \Respect\Validation\Rules\AbstractAge
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MaximumAgeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new MaximumAge(30, 'Y-m-d'), date('Y-m-d', strtotime('30 years ago'))],
            [new MaximumAge(30, 'Y-m-d'), date('Y-m-d', strtotime('29 years ago'))],
            [new MaximumAge(30), '30 years ago'],
            [new MaximumAge(30), '29 years ago'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new MaximumAge(30), new DateTime('30 years ago')],
            [new MaximumAge(30), new DateTime('29 years ago')],
            [new MaximumAge(30), new DateTimeImmutable('30 years ago')],
            [new MaximumAge(30), new DateTimeImmutable('29 years ago')],
            [new MaximumAge(30, 'Y-m-d'), new DateTime('30 years ago')],
            [new MaximumAge(30, 'Y-m-d'), new DateTimeImmutable('30 years ago')],
            [new MaximumAge(30, 'Y-m-d'), '30 years ago'],
            [new MaximumAge(30, 'Y-m-d'), date('Y/m/d', strtotime('30 years ago'))],
            [new MaximumAge(30), new DateTime('31 years ago')],
            [new MaximumAge(30), new DateTimeImmutable('31 years ago')],
            [new MaximumAge(30), '31 years ago'],
            [new MaximumAge(30, 'Y-m-d'), date('Y-m-d', strtotime('31 years ago'))],
            [new MaximumAge(30), 'invalid-input'],
            [new MaximumAge(30), new stdClass()],
        ];
    }
}
