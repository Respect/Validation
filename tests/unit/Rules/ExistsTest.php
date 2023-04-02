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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Exists
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kennedy Tedesco <kennedyt.tw@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class ExistsTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Exists();

        return [
            [$rule, __FILE__],
            [$rule, new SplFileInfo(__FILE__)],
            [$rule, new SplFileObject(__FILE__)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Exists();

        return [
            [$rule, 'path/of/a/non-existent/file'],
            [$rule, new SplFileInfo('path/of/a/non-existent/file')],
        ];
    }
}
