<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Test\TestCase;

/**
 * @group helper
 *
 * @covers \Respect\Validation\Helpers\CanValidateDateTime
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CanValidateDateTimeTest extends TestCase
{
    use CanValidateDateTime;

    /**
     * @test
     *
     * @dataProvider providerForValidDateTime
     */
    public function shouldFindWhenValueIsDateTime(string $format, string $value): void
    {
        self::assertTrue($this->isDateTime($format, $value));
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidDateTime
     */
    public function shouldFindWhenValueIsNotDateTime(string $format, string $value): void
    {
        self::assertFalse($this->isDateTime($format, $value));
    }

    /**
     * @return mixed[][]
     */
    public static function providerForValidDateTime(): array
    {
        return [
            ['Y-m-d', '2009-09-09'],
            ['Y-m-d', '2020-02-29'],
            ['Ymd', '20090909'],
            ['d/m/Y', '23/05/1987'],
            ['c', '2018-01-30T19:04:35+00:00'],
            ['Y-m-d\TH:i:sP', '2018-01-30T19:04:35+00:00'],
            ['r', 'Tue, 30 Jan 2018 19:06:01 +0000'],
            ['D, d M Y H:i:s O', 'Tue, 30 Jan 2018 19:06:01 +0000'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerForInvalidDateTime(): array
    {
        return [
            ['Y-m-d', '0000-01-01'],
            ['Y-m-d', '2021-02-29'],
            ['y-m-d', '2009-09-12'],
            ['Y-m-d', '0000-00-31'],
            ['Y-m-d', '0000-12-00'],
            ['Y-m-d H:i:s', '1987-12-31'],
        ];
    }
}
