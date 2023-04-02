<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use DateTimeImmutable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Date
 *
 * @author Bruno Luiz da Silva <contato@brunoluiz.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateTest extends RuleTestCase
{
    /**
     * @test
     *
     * @dataProvider validFormatsProvider
     */
    public function shouldThrowAnExceptionWhenFormatIsNotValid(string $format): void
    {
        $this->expectException(ComponentException::class);

        new Date($format);
    }

    /**
     * @test
     */
    public function shouldPassFormatToParameterToException(): void
    {
        $format = 'F jS, Y';
        $equals = new Date($format);
        $exception = $equals->reportError('input');

        self::assertSame($format, $exception->getParam('format'));
    }

    /**
     * @return string[][]
     */
    public static function validFormatsProvider(): array
    {
        return [
            ['Y-m-d H:i:s'],
            ['c'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Date(), '2017-12-31'],
            [new Date('m/d/y'), '12/31/17'],
            [new Date('F jS, Y'), 'May 1st, 2017'],
            [new Date('Ydm'), 20173112],
            [new Date(), '2020-02-29'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Date(), 'not-a-date'],
            [new Date(), []],
            [new Date(), true],
            [new Date(), false],
            [new Date(), null],
            [new Date(), ''],
            [new Date(), '1988-02-30'],
            [new Date('d/m/y'), '12/31/17'],
            [new Date(), '2019-02-29'],
            [new Date(), new DateTime()],
            [new Date(), new DateTimeImmutable()],
            [new Date(), ''],
            [new Date('Y-m-d'), '2009-12-00'],
            [new Date('Y-m-d'), '2018-02-29'],
            [new Date(), '2014-99'],
            [new Date('d'), 1],
            [new Date('Y-m'), '2014-99'],
            [new Date('m'), '99'],
        ];
    }
}
