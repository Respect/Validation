<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\StreamStub;
use SplFileInfo;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Readable
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ReadableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $file = self::fixture('valid-image.gif');
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, StreamStub::create()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $file = self::fixture('invalid-image.gif');
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, new stdClass()],
            [$rule, StreamStub::createUnreadable()],
        ];
    }
}
