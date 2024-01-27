<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Test\DataProvider\UndefinedProvider;
use Respect\Validation\Test\TestCase;

/**
 * @group helper
 * @covers \Respect\Validation\Helpers\CanValidateUndefined
 */
final class CanValidateUndefinedTest extends TestCase
{
    use CanValidateUndefined;
    use UndefinedProvider;

    /**
     * @test
     * @dataProvider providerForUndefined
     */
    public function shouldFindWhenValueIsUndefined(mixed $value): void
    {
        self::assertTrue($this->isUndefined($value));
    }

    /**
     * @test
     * @dataProvider providerForNotUndefined
     */
    public function shouldFindWhenValueIsNotUndefined(mixed $value): void
    {
        self::assertFalse($this->isUndefined($value));
    }
}
