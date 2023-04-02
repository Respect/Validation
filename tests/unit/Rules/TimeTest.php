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
 * @covers \Respect\Validation\Rules\Time
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TimeTest extends RuleTestCase
{
    /**
     * @test
     *
     * @dataProvider invalidFormatsProvider
     */
    public function shouldThrowAnExceptionWhenFormatIsNotValid(string $format): void
    {
        $this->expectException(ComponentException::class);

        new Time($format);
    }

    /**
     * @test
     */
    public function shouldPassFormatToParameterToException(): void
    {
        $format = 'g:i A';
        $equals = new Time($format);
        $exception = $equals->reportError('input');

        self::assertSame($format, $exception->getParam('format'));
    }

    /**
     * @return mixed[][]
     */
    public static function invalidFormatsProvider(): array
    {
        return [
            ['Y-m-d H:i:s'],
            ['M g:i A'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Time(), '00:00:00'],
            [new Time(), '23:20:59'],
            [new Time('H:i'), '23:59'],
            [new Time('g:i A'), '8:13 AM'],
            [new Time('His'), 232059],
            [new Time('H:i:s.u'), '08:16:01.000000'],
            [new Time('ga'), '3am'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Time(), '00:00:60'],
            [new Time(), '00:60:00'],
            [new Time(), '24:00:00'],
            [new Time(), '00:00'],
            [new Time(), new DateTime()],
            [new Time(), new DateTimeImmutable()],
            [new Time(), ''],
        ];
    }
}
