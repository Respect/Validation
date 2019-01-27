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
use stdClass;
use function date;
use function strtotime;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractAge
 * @covers \Respect\Validation\Rules\MinAge
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Kennedy Tedesco <kennedyt.tw@gmail.com>
 */
final class MinAgeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('18 years ago'))],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('19 years ago'))],
            [new MinAge(18), '18 years ago'],
            [new MinAge(18), '19 years ago'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new MinAge(18), new DateTime('18 years ago')],
            [new MinAge(18), new DateTimeImmutable('19 years ago')],
            [new MinAge(18, 'Y-m-d'), new DateTime('100 years ago')],
            [new MinAge(18, 'Y-m-d'), new DateTimeImmutable('18 years ago')],
            [new MinAge(18, 'Y-m-d'), '100 years ago'],
            [new MinAge(18, 'Y-m-d'), '18 years ago'],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('17 years ago'))],
            [new MinAge(18), 'invalid-input'],
            [new MinAge(18), new stdClass()],
            [new MinAge(18, 'Y-m-d'), date('Y/m/d', strtotime('18 years ago'))],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('17 years ago'))],
            [new MinAge(18), new DateTime('17 years ago')],
            [new MinAge(18), new DateTimeImmutable('17 years ago')],
            [new MinAge(18), '17 years ago'],
        ];
    }
}
