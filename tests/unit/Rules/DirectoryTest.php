<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;
use stdClass;

use function dir;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Directory
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class DirectoryTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Directory();

        return [
            [$rule, __DIR__],
            [$rule, new SplFileInfo(__DIR__)],
            [$rule, dir(__DIR__)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Directory();

        return [
            [$rule, new SplFileInfo(__FILE__)],
            [$rule, new SplFileObject(__FILE__)],
            [$rule, ''],
            [$rule, __FILE__],
            [$rule, new stdClass()],
            [$rule, [__DIR__]],
        ];
    }
}
