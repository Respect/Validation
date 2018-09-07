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
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\LeapDate
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapDateTest extends RuleTestCase
{
    /*
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new LeapDate('Y-m-d'), '1988-02-29'],
            [new LeapDate('Y-m-d'), '1992-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1988-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1992-02-29')],
        ];
    }

    /*
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new LeapDate('Y-m-d'), '1989-02-29'],
            [new LeapDate('Y-m-d'), '1993-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1989-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1993-02-29')],
            [new LeapDate('Y-m-d'), []],
        ];
    }
}
