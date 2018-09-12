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
 * @covers \Respect\Validation\Rules\LeapYear
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapYearTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, '2008'],
            [$rule, '2008-02-29'],
            [$rule, 2008],
            [$rule, 2008],
            [$rule, new DateTime('2008-02-29')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, ''],
            [$rule, '2009'],
            [$rule, '2009-02-29'],
            [$rule, 2009],
            [$rule, new DateTime('2009-02-29')],
            [$rule, []],
        ];
    }
}
