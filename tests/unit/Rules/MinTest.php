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
 * @covers \Respect\Validation\Rules\Min
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MinTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            // From documentation
            [new Min(10), 10],
            [new Min(10), 11],
            [new Min('2010-01-01'), '2010-01-01'],
            [new Min(new DateTime('yesterday')), new DateTimeImmutable('tomorrow')],
            [new Min('1988-09-09'), '18 years ago'],
            [new Min('a'), 'b'],

            [new Min(100), 165.0],
            [new Min(-100), 200],
            [new Min(200), 200],
            [new Min(200), 300],
            [new Min('a'), 'a'],
            [new Min('a'), 'c'],
            [new Min('yesterday'), 'now'],
            // Samples from issue #178
            [new Min('13-05-2014 03:16'), '20-05-2014 03:16'],
            [new Min(new DateTime('13-05-2014 03:16')), new DateTime('20-05-2014 03:16')],
            [new Min('13-05-2014 03:16'), new DateTime('20-05-2014 03:16')],
            [new Min(new DateTime('13-05-2014 03:16')), '20-05-2014 03:16'],
            [new Min(50), 50],
            [new Min(new CountableStub(10)), 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            // From documentation
            [new Min(10), 9],
            [new Min('2011-01-01'), '2009-01-01'],
            [new Min(new DateTimeImmutable('+1 month')), new DateTime('today')],
            [new Min('+1 minute'), new DateTime('now')],
            [new Min('C'), 'A'],

            [new Min(100), ''],
            [new Min(100), ''],
            [new Min(500), 300],
            [new Min(0), -250],
            [new Min(0), -50],
            [new Min(new CountableStub(1)), 0],
            [new Min(2040), '2018-01-25'],
            [new Min(10.5), '2018-01-25'],
        ];
    }
}
