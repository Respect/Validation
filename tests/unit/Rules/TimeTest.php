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
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
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
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
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

    public function invalidFormatsProvider(): array
    {
        return [
            ['Y-m-d H:i:s'],
            ['M g:i A'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider invalidFormatsProvider
     *
     * @param string $format
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
}
